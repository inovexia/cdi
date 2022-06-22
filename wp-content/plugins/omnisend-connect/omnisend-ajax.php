<?php
if (!defined('ABSPATH')) {
    exit;
}

add_action('wp_ajax_save_omnisend_api_key', 'save_omnisend_api_key');
add_action('wp_ajax_nopriv_save_omnisend_api_key', 'save_omnisend_api_key');

function save_omnisend_api_key()
{
    OmnisendLogger::hook();
    $result = [];
    $result['success'] = false;
    $result['omnisend_api_key'] = sanitize_text_field(trim($_POST['omnisend_api_key']));

    if (isset($result['omnisend_api_key']) && $result['omnisend_api_key'] == get_option('omnisend_api_key', null)) {
        $result['msg'] = "Error: this API key is already in use, please use a new one.";
        OmnisendLogger::warning($result['msg']);
    } else if (isset($result['omnisend_api_key'])) {

        $account_id = substr($result['omnisend_api_key'], 0, strpos($result['omnisend_api_key'], '-'));
        //check if there was different accound ID and set resync
        if (get_option("omnisend_account_id", null) && get_option("omnisend_account_id", null) != $account_id) {
            delete_metadata("post", "0", "omnisend_last_sync", '', true);
            delete_metadata("user", "0", "omnisend_last_sync", '', true);
            delete_metadata("term", "0", "omnisend_last_sync", '', true);
            delete_option("omnisend_initial_sync");
        }

        /*Save Account ID into database*/
        update_option('omnisend_account_id', $account_id);

        /*Check if API key is valid*/
        $link = OMNISEND_URL . "accounts";
        $response = OmnisendHelper::omnisendApi($link, "GET", ['apiKey' => $result['omnisend_api_key']]);
        if ($response['code'] == 200) {
            $r = json_decode($response['response'], true);
            if ($r['verified'] == true) {
                $result['success'] = true;
                //write to DB
                // /*Save API key into database*/
                update_option('omnisend_api_key', $result['omnisend_api_key']);
                OmnisendManager::updateAccountInfo();

                OmnisendLogger::info('API KEY saved. ');
                OmnisendManagerAssistant::initSync();
            } else {
                //try to verify
                require_once ABSPATH . 'wp-admin/includes/plugin.php';
                $link = OMNISEND_URL . "accounts";

                $data = OmnisendHelper::getAccountInfo();
                $data['apiKey'] = $result['omnisend_api_key'];
                $data['verificationUrl'] = plugin_dir_url(__FILE__) . "omnisend-verify.php";
                $response = OmnisendHelper::omnisendApi($link, "POST", $data);
                if ($response['code'] == 200) {
                    //got answer
                    $r = json_decode($response['response'], true);
                    if ($r['verified'] == true) {
                        $result['success'] = true;
                        $result['msg'] = "Account verified.";
                        OmnisendLogger::info('Verifiction successful.');
                        //write to DB
                        // /*Save API key into database*/
                        update_option('omnisend_api_key', $result['omnisend_api_key']);

                        OmnisendLogger::info('API KEY saved. ');
                        OmnisendManagerAssistant::initSync();

                        $response['api_key'] = $result['omnisend_api_key'];
                        $response['body'] = 'API key setted successfully! All Contacts, Products and Orders will be synchronized with Omnisend in Background Process.';

                    } else {
                        if (array_key_exists('error', $r) && $r['error'] != "") {
                            $result['msg'] = $r['error'];
                            OmnisendLogger::generalLogging("warn", "accounts", $link, $r['error']);
                        } else {
                            $result['msg'] = "Error: we are unable to verify your site. Please check if your site is accessible and retry. Refer to our <a href='https://support.omnisend.com/' target='_blank'>Knowledge Base</a> if the issue persists.";
                            OmnisendLogger::generalLogging("warn", "accounts", $link, $result['msg']);
                        }
                    }
                } else {
                    $result['msg'] = "Error: while API key is correct, we are unable to verify your site. Please try again in a couple of minutes. Refer to our <a href='https://support.omnisend.com/' target='_blank'>Knowledge Base</a> if the issue persists.";
                    OmnisendLogger::generalLogging("warn", "accounts", $link, $result['msg']);
                }
            }
        } else {
            $result['msg'] = "We couldn’t verify your site. Make sure you’re entering your Omnisend API key.";
            OmnisendLogger::warning($result['msg']);
            delete_option('omnisend_account_id');
        }
    }
    echo json_encode($result);
    exit;
}

add_action('wp_ajax_omnisend_identify', 'hook_omnisend_ajax_save_email');
add_action('wp_ajax_nopriv_omnisend_identify', 'hook_omnisend_ajax_save_email');
function hook_omnisend_ajax_save_email() {
    OmnisendLogger::hook();
    $email = !empty($_GET['email']) ? $_GET['email'] : null;
    echo OmnisendAjax::identifyByEmail($email)->toString();
    exit;
}

class OmnisendAjax {
    /**
     * @return OmnisendOperationStatus
     */
    public static function identifyByEmail($email) {
        if (!OmnisendManager::isSetup()) {
            return OmnisendOperationStatus::error('Omnisend is not setup');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return OmnisendOperationStatus::error('Incorrect request (email)');
        }

        if (OmnisendContactResolver::updateByEmail($email)) {
            self::triggerCartPush();
            return OmnisendOperationStatus::success();
        }

        $apiUrl = OMNISEND_URL . 'contacts';
        $curlResult = OmnisendHelper::omnisendApi($apiUrl, 'POST', self::generateContactPayload($email));
        if ($curlResult['code'] < 200 || $curlResult['code'] >= 300) {
            OmnisendLogger::generalLogging("warn", "contacts", $apiUrl, 'Unable to push contact ' . $email. ' to Omnisend.' . $curlResult['response']);
            return OmnisendOperationStatus::error('Unable to create contact (api error)');
        }
        OmnisendLogger::generalLogging("info", "contacts", $apiUrl, 'Contact ' . $email . ' was successfully pushed to Omnisend.');

        $response = json_decode($curlResult['response'], true);
        if (empty($response["contactID"])) {
            OmnisendLogger::generalLogging("warn", "contacts", $apiUrl, 'Unable to push contact ' . $email. ' to Omnisend. Unexpected API response: ' . $curlResult['response']);
            return OmnisendOperationStatus::error('Unable to identify contact (api error)');
        }

        OmnisendContactResolver::updateByEmailAndContactId($email, $response['contactID']);
        self::triggerCartPush();

        return OmnisendOperationStatus::success();
    }

    private static function generateContactPayload($email) {
        $tag = get_option("omnisend_contact_tag", null);

        return [
            'email'      => $email,
            'status'     => 'nonSubscribed',
            'statusDate' => date(DATE_ATOM),
            'tags'       => $tag ? ['source: woocommerce', $tag] : ['source: woocommerce'],
        ];
    }

    private static function triggerCartPush() {
        if (!WC()->cart->is_empty()) {
            OmnisendManager::pushCartToOmnisend();
        }
    }
}

class OmnisendOperationStatus {
    /**
     * @var bool
     */
    private $success;

    /**
     * @var string
     */
    private $message;

    /**
     * @return OmnisendOperationStatus
     */
    public static function success() {
        return new OmnisendOperationStatus(true, '');
    }

    /**
     * @param $message
     *
     * @return OmnisendOperationStatus
     */
    public static function error($message) {
        return new OmnisendOperationStatus(false, $message);
    }

    /**
     * @param $success bool
     * @param $message string
     */
    private function __construct($success, $message)
    {
        $this->success = $success;
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function toString() {
        return json_encode(['success' => $this->success, 'message' => $this->message]);
    }
}
