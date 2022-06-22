<?php
if (!defined('ABSPATH')) {
    exit;
}
class OmnisendManagerAssistant
{

    public static function batchCheck()
    {
        OmnisendLogger::hook();
        $batches = get_option('omnisend_batches_inProgress');
        
        if (empty($batches)) {
            OmnisendInitSyncManager::finishCheckBatches();
            return;
        }

        
        $i = 0;
        $remove_batches = array();
        $renew_orders = 0;
        $renew_products = 0;
        $renew_contacts = 0;

        foreach ($batches as $key => $batchID) {
            $link = OMNISEND_URL . "batches/" . $batchID;
            $response = OmnisendHelper::omnisendApi($link, "GET", []);
            if ($response['code'] >= 200 && $response['code'] < 300) {
                $r = json_decode($response['response'], true);
                if ($r["status"] == "finished" || $r["status"] == "stopped") {
                    if ($r['errorsCount'] != 0) {
                        //check items
                        $link = OMNISEND_URL . "batches/" . $batchID . "/items";
                        $response_batch = OmnisendHelper::omnisendApi($link, "GET", []);
                        if ($response_batch['code'] >= 200 && $response_batch['code'] < 300) {
                            $r_batch = json_decode($response_batch['response'], true);
                            if (!empty($r_batch['errors'])) {
                                foreach ($r_batch['errors'] as $item) {
                                    if ($item['responseCode'] == "503" || $item['responseCode'] == "429" || $item['responseCode'] == "408" || $item['responseCode'] == "403") {
                                        //retry
                                        if ($r["endpoint"] == "orders") {
                                            $last_sync = get_post_meta($item['request']['orderID'], 'omnisend_last_sync', true);
                                            if ($last_sync != "" && $last_sync != OmnisendSync::STATUS_ERROR) {
                                                $last_sync = strtotime($last_sync);
                                            }
                                            if ($last_sync != OmnisendSync::STATUS_ERROR && ($last_sync < (strtotime($r["createdAt"]) + 30) || $last_sync == "")) {
                                                delete_post_meta($item['request']['orderID'], 'omnisend_last_sync');
                                                $renew_orders = 1;
                                            }
                                        } elseif ($r["endpoint"] == "products") {
                                            $last_sync = get_post_meta($item['request']['productID'], 'omnisend_last_sync', true);
                                            if ($last_sync != "" && $last_sync != OmnisendSync::STATUS_ERROR) {
                                                $last_sync = strtotime($last_sync);
                                            }
                                            if ($last_sync != OmnisendSync::STATUS_ERROR && ($last_sync < (strtotime($r["createdAt"]) + 30) || $last_sync == "")) {
                                                delete_post_meta($item['request']['productID'], 'omnisend_last_sync');
                                                $renew_products = 1;
                                            }
                                        } else if ($r["endpoint"] == "contacts") {
                                            $user = get_user_by("email", $item['request']['email']);
                                            if (!empty($user)) {
                                                $last_sync = get_user_meta($user->ID, 'omnisend_last_sync', true);
                                                if ($last_sync != "" && $last_sync != OmnisendSync::STATUS_ERROR) {
                                                    $last_sync = strtotime($last_sync);
                                                }
                                                if ($last_sync != OmnisendSync::STATUS_ERROR && ($last_sync < (strtotime($r["createdAt"]) + 30) || $last_sync == "")) {
                                                    delete_user_meta($user->ID, 'omnisend_last_sync');
                                                    $renew_contacts = 1;
                                                }

                                            }

                                        }
                                    }
                                }
                            }
                        }

                    }
                    //remove batch from inProgress
                    $remove_batches[] = $batchID;

                }
            } else if ($response['code'] == 404) {
                $remove_batches[] = $batchID;
            }

            if ($i > 3) {
                break;
            }

            $i++;
        }
        
        // Update inProgress batches
        update_option('omnisend_batches_inProgress', array_diff($batches, $remove_batches));

        // Reshedule sync cron jobs
        if ($renew_contacts == 1) {
            OmnisendInitSyncManager::startContacts();
        }

        if ($renew_orders == 1) {
            OmnisendInitSyncManager::startOrders();
        }

        if ($renew_products == 1) {
            OmnisendInitSyncManager::startProducts();
        }
    }

    // In future version must be removed
    // because lists is deprected
    public static function getList($listID)
    {
        $link = OMNISEND_URL . "lists/" . $listID;
        $curlResult = OmnisendHelper::omnisendApi($link, "GET", []);
        if ($curlResult['code'] == 200) {
            return json_decode($curlResult['response'], true);
        } else {
            return false;
        }
    }

    public static function getApiKeyPermissions()
    {
        $permissions = array();
        $link = OMNISEND_URL . "accounts";
        $curlResult = OmnisendHelper::omnisendApi($link, "GET", []);
        $permissions['contacts'] = false;
        $permissions['orders'] = false;
        $permissions['products'] = false;
        $permissions['carts'] = false;
        $permissions['lists'] = false;

        if (array_key_exists("response", $curlResult)) {
            if ($curlResult['code'] != 500) {
                $r = json_decode($curlResult['response'], true);
                if (array_key_exists("apiKeyPermissions", $r)) {
                    $permissions['contacts'] = $r['apiKeyPermissions']['contacts'];
                    if ($r['apiKeyPermissions']['contactsSafe'] || $r['apiKeyPermissions']['contacts']) {
                        $permissions['contacts'] = true;
                    }
                    $permissions['orders'] = $r['apiKeyPermissions']['orders'];
                    $permissions['products'] = $r['apiKeyPermissions']['products'];
                    $permissions['carts'] = $r['apiKeyPermissions']['carts'];
                    $permissions['lists'] = $r['apiKeyPermissions']['lists'];
                }
            }
        }

        return $permissions;

    }

    public static function unsetUserCart($all = false)
    {
        if ($all && null !== WC()->session) {
            WC()->session->set('omnisend_cart_synced', null);
            WC()->session->set('omnisend_cartID', null);
            WC()->session->set('omnisend_cart', null);
        }

        $user_id = get_current_user_id();
        if ($user_id > 0) {
            delete_user_meta($user_id, 'omnisend_cartID');
            delete_user_meta($user_id, 'omnisend_cart_synced');
        }
    }

    public static function getEmailFromOmnisend($contactID)
    {
        $link = OMNISEND_URL . "contacts/" . $contactID;
        $curlResult = OmnisendHelper::omnisendApi($link, "GET", []);
        return $curlResult['response'];
    }

    // Sync contacts via batches
    public static function syncAllContacts()
    {
        OmnisendLogger::hook();
        if (OmnisendInitSyncManager::isContactsFinished()) {
            return;
        }

        if (empty(get_option('omnisend_api_key', null))) {
            OmnisendInitSyncManager::stopContacts('no API key');
            return;
        }

        $wp_user_query = new WP_User_Query(array(
            'number' => 1000,
            'meta_query' => array(
                'relation' => 'OR',
                array(
                    'key' => 'omnisend_last_sync',
                    'compare' => 'NOT EXISTS',
                    'value' => '',
                ),
            ),
        ));
        $users = $wp_user_query->get_results();

        if (empty($users)) {
            OmnisendInitSyncManager::finishContacts();
            return;
        }

        //form batch request and save batchID
        $args = array();
        $args["method"] = "POST";
        $args["endpoint"] = "contacts";
        $args["items"] = array();
        $skippedContactIds = [];
        foreach ($users as $user) {
            $preparedContact = OmnisendContact::create($user);
            if ($preparedContact) {
                $preparedContact = OmnisendHelper::cleanModelFromEmptyFields($preparedContact);
                $args["items"][] = $preparedContact;
            } else {
                $skippedContactIds[] = $user->ID;
            }
        }
        $link = OMNISEND_URL . "batches";
        $response = OmnisendHelper::omnisendApi($link, "POST", $args);
        if ($response['code'] >= 200 && $response['code'] < 300) {
            //batch ID
            $status = date(DATE_ATOM, time());
            $r = json_decode($response['response'], true);
            $batchID = $r["batchID"];
            if (strlen($batchID) == 24) {
                //write batch to check response later
                $batches_inProgress = get_option("omnisend_batches_inProgress");
                if (!is_array($batches_inProgress)) {
                    $batches_inProgress = array();
                }
                if (!in_array($batchID, $batches_inProgress)) {
                    $batches_inProgress[] = $batchID;
                    update_option("omnisend_batches_inProgress", $batches_inProgress);
                }
                OmnisendLogger::generalLogging("info", "batches", $link, 'Batch sync: contacts were succesfully pushed to Omnisend');
            } else {
                OmnisendLogger::generalLogging("warn", "batches", $link, 'Batch sync error: unable to push contacts to Omnisend');
                $status = OmnisendSync::STATUS_ERROR;
            }
        } else {
            OmnisendLogger::generalLogging("warn", "batches", $link, 'Batch sync error: unable to push contacts to Omnisend');
            $status = OmnisendSync::STATUS_ERROR;
        }

        foreach ($users as $user) {
            // Update contact with last update date or mark it as "error" or "skipped"
            $userStatus = in_array($user->ID, $skippedContactIds) ? OmnisendSync::STATUS_SKIPPED : $status;
            update_user_meta($user->ID, 'omnisend_last_sync', $userStatus);
        }
    }

    // Sync orders via batches
    public static function syncAllOrders()
    {
        OmnisendLogger::hook();
        if (OmnisendInitSyncManager::isOrdersFinished()) {
            return;
        }

        if (empty(get_option('omnisend_api_key', null))) {
            OmnisendInitSyncManager::stopOrders('no API key');
            return;
        }

        $orders = get_posts(array(
            'fields' => 'ids',
            'posts_per_page' => '500',
            'post_type' => 'shop_order',
            'post_status' => array(wc_get_order_statuses()),
            'meta_query' => array(
                'relation' => 'OR',
                array(
                    'key' => OmnisendSync::FIELD_NAME,
                    'compare' => 'NOT EXISTS',
                    'value' => '',
                ),
            ),
        ));

        if (empty($orders)) {
            OmnisendInitSyncManager::finishOrders();
            return;
        }

        //form batch request and save batchID
        $args = array();
        $args["method"] = "POST";
        $args["endpoint"] = "orders";
        $args["items"] = array();
        $skippedOrderIds = [];
        
        foreach ($orders as $orderID) {
            $preparedOrder = OmnisendOrder::create($orderID);
            if ($preparedOrder) {
                $preparedOrder = OmnisendHelper::cleanModelFromEmptyFields($preparedOrder);
                $args["items"][] = $preparedOrder;
            } else {
                $skippedOrderIds[] = $orderID;
            }
        }

        if (count($args["items"]) > 0) {
            $link = OMNISEND_URL . "batches";
            $response = OmnisendHelper::omnisendApi($link, "POST", $args);
            if ($response['code'] >= 200 && $response['code'] < 300) {
                //batch ID
                $status = date(DATE_ATOM, time());
                $r = json_decode($response['response'], true);
                $batchID = $r["batchID"];
                if (strlen($batchID) == 24) {
                    //write batch to check response later
                    $batches_inProgress = get_option("omnisend_batches_inProgress");
                    if (!is_array($batches_inProgress)) {
                        $batches_inProgress = array();
                    }
                    if (!in_array($batchID, $batches_inProgress)) {
                        $batches_inProgress[] = $batchID;
                        update_option("omnisend_batches_inProgress", $batches_inProgress);
                    }
                    OmnisendLogger::generalLogging("info", "batches", $link, 'Batch sync: orders were succesfully pushed to Omnisend');
                    OmnisendLogger::countItem("orders", $r['totalCount']);
                } else {
                    OmnisendLogger::generalLogging("warn", "batches", $link, 'Batch sync error: unable to push orders to Omnisend');
                    $status = OmnisendSync::STATUS_ERROR;
                }
            } else {
                OmnisendLogger::generalLogging("warn", "batches", $link, 'Batch sync error: unable to push orders to Omnisend');
                $status = OmnisendSync::STATUS_ERROR;
            }
        } else {
            $status = OmnisendSync::STATUS_SKIPPED;
        }

        foreach ($orders as $orderID) {
            // Update order with last update date or mark it as "error" or "skipped"
            $orderStatus = in_array($orderID, $skippedOrderIds) ? OmnisendSync::STATUS_SKIPPED : $status;
            update_post_meta($orderID, 'omnisend_last_sync', $orderStatus);
        }
    }

    // Sync products via batches
    public static function syncAllProducts()
    {
        OmnisendLogger::hook();
        if (OmnisendInitSyncManager::isProductsFinished()) {
            return;
        }

        if (empty(get_option('omnisend_api_key', null))) {
            OmnisendInitSyncManager::stopProducts('no API key');
            return;
        }

        $products = get_posts(array(
            'fields' => 'ids',
            'posts_per_page' => '1000',
            'post_type' => 'product',
            'has_password' => false,
            'post_status' => 'publish',
            'meta_query' => array(
                'relation' => 'OR',
                array(
                    'key' => 'omnisend_last_sync',
                    'compare' => 'NOT EXISTS',
                    'value' => '',
                ),
            ),
        ));

        if (empty($products)) {
            OmnisendInitSyncManager::finishProducts();
            return;
        }

        //form batch request and save batchID
        $args = array();
        $args["method"] = "POST";
        $args["endpoint"] = "products";
        $args["items"] = array();
        foreach ($products as $productID) {
            $preparedProduct = OmnisendProduct::create($productID);
            if ($preparedProduct) {
                $preparedProduct = OmnisendHelper::cleanModelFromEmptyFields($preparedProduct);
                $args["items"][] = $preparedProduct;
            }
        }
        $link = OMNISEND_URL . "batches";
        $response = OmnisendHelper::omnisendApi($link, "POST", $args);
        if ($response['code'] >= 200 && $response['code'] < 300) {
            //batch ID
            $status = date(DATE_ATOM, time());
            $r = json_decode($response['response'], true);
            $batchID = $r["batchID"];
            if (strlen($batchID) == 24) {
                //write batch to check response later
                $batches_inProgress = get_option("omnisend_batches_inProgress");
                if (!is_array($batches_inProgress)) {
                    $batches_inProgress = array();
                }
                if (!in_array($batchID, $batches_inProgress)) {
                    $batches_inProgress[] = $batchID;
                    update_option("omnisend_batches_inProgress", $batches_inProgress);
                }
                OmnisendLogger::generalLogging("info", "batches", $link, 'Batch sync: products were succesfully pushed to Omnisend');
                OmnisendLogger::countItem("products", $r['totalCount']);
            } else {
                OmnisendLogger::generalLogging("warn", "batches", $link, 'Batch sync error: unable to push products to Omnisend');
                $status = OmnisendSync::STATUS_ERROR;
            }
        } else {
            OmnisendLogger::generalLogging("warn", "batches", $link, 'Batch sync error: unable to push products to Omnisend');
            $status = OmnisendSync::STATUS_ERROR;
        }

        foreach ($products as $productID) {
            // Update product with last update date or mark it as "error"
            update_post_meta($productID, 'omnisend_last_sync', $status);
        }
    }

    public static function syncAllCategories()
    {
        OmnisendLogger::hook();
        if (OmnisendInitSyncManager::isCategoriesFinished()) {
            return;
        }

        if (!OmnisendManager::isSetup()) {
            OmnisendInitSyncManager::stopCategories('Plugin is not setup');
            return;
        }

        $categories = self::getNotSyncedCategories();
        if (empty($categories)) {
            OmnisendInitSyncManager::finishCategories();
            return;
        }

        foreach ($categories as $category) {
            OmnisendManager::pushCategoryToOmnisend($category->term_id);
        }
    }

    private static function getNotSyncedCategories() {
        return get_categories([
            'taxonomy'     => 'product_cat',
            'number'       => 40,
            'hierarchical' => 0,
            'hide_empty'   => 0,
            'meta_query'   => [
                'relation' => 'OR',
                [
                    'key'     => 'omnisend_last_sync',
                    'compare' => 'NOT EXISTS',
                    'value'   => '',
                ],
            ],
        ]);
    }

    public static function initSync()
    {
        OmnisendInitSyncManager::startContactsIfNotFinished();
        OmnisendInitSyncManager::startOrdersIfNotFinished();
        OmnisendInitSyncManager::startProductsIfNotFinished();
        OmnisendInitSyncManager::startCategoriesIfNotFinished();
    }
}

add_action('omnisend_init_contacts_sync', 'OmnisendManagerAssistant::syncAllContacts');
add_action('omnisend_init_orders_sync', 'OmnisendManagerAssistant::syncAllOrders');
add_action('omnisend_init_products_sync', 'OmnisendManagerAssistant::syncAllProducts');
add_action('omnisend_init_categories_sync', 'OmnisendManagerAssistant::syncAllCategories');
add_action('omnisend_batch_check', 'OmnisendManagerAssistant::batchCheck');
