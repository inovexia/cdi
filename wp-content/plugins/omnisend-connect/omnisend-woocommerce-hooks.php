<?php
//global variables
$cart_converted = false;
$pickerProductSet = false;

/**PRODUCTS **/
add_action('woocommerce_new_product', 'omnisend_on_product_change', 100, 1);
add_action('woocommerce_update_product', 'omnisend_on_product_change', 100, 1);
add_action('trash_product', 'omnisend_product_delete');

// product create or update
function omnisend_on_product_change($post_id)
{
    OmnisendLogger::hook();
    remove_action('woocommerce_update_product', 'omnisend_on_product_change');
    if (OmnisendHelper::isWooCommercePluginActivated()) {
        OmnisendManager::pushProductToOmnisend($post_id);
    }
}

/* product create or update */
function omnisend_product_delete($post_id)
{
    OmnisendLogger::hook();
    if (OmnisendHelper::isWooCommercePluginActivated()) {
        OmnisendManager::deleteProductFromOmnisend($post_id);
    }
}

/* product page - add Product Picker */
add_action('woocommerce_after_single_product', 'omnisend_product_picker', 5);
function omnisend_product_picker()
{
    OmnisendLogger::hook();
    global $pickerProductSet;
    if ($pickerProductSet == false) {
        $pickerProductSet = true;
        OmnisendProduct::productPicker();
    }
}

/**PRODUCT CATEGORIES **/
add_action('edited_product_cat', 'omnisend_on_category_change', 10, 2);
add_action('create_product_cat', 'omnisend_on_category_change', 10, 2);
add_action('delete_product_cat', 'omnisend_category_delete', 10, 1);

// category create or update
function omnisend_on_category_change($term_id, $tt_id = '')
{
    OmnisendLogger::hook();
    remove_action('edited_product_cat', 'omnisend_on_category_change');
    OmnisendManager::pushCategoryToOmnisend($term_id);
}

/* category create or update */
function omnisend_category_delete($post_id)
{
    OmnisendLogger::hook();
    if (OmnisendHelper::isWooCommercePluginActivated()) {
        OmnisendManager::deleteCategoryFromOmnisend($post_id);
    }
}

/* CONTACT */
add_action('profile_update', 'omnisend_on_user_update', 10, 2);
function omnisend_on_user_update($user_id)
{
    OmnisendLogger::hook();
    OmnisendManager::pushContactToOmnisend($user_id);
    OmnisendContactResolver::updateByUserId($user_id);
}

add_action('user_register', 'omnisend_on_user_register', 10, 1);
function omnisend_on_user_register($user_id)
{
    OmnisendLogger::hook();
    OmnisendManager::pushContactToOmnisend($user_id);
    OmnisendContactResolver::updateByUserId($user_id);
}

/**ORDERS*/

/*Hook for triggering action when order created*/
//add_action('woocommerce_thankyou', 'omnisend_order_created', 10, 1);
add_action('woocommerce_checkout_update_order_meta', 'omnisend_order_created', 20, 2);
function omnisend_order_created($order_id)
{
    OmnisendLogger::hook();

    global $cart_converted;
    $cart_converted = true;
    //add cartID to order, if doesn't exist
    $cart_id = OmnisendServerSession::get('omnisend_cartID');
    if ($cart_id != "") {
        add_post_meta($order_id, 'omnisend_cartID', $cart_id, true);
    }
    if (OmnisendUserStorage::getAttributionId()) {
        add_post_meta($order_id, 'omnisendAttributionID', OmnisendUserStorage::getAttributionId(), true);
    }
    OmnisendManager::pushOrderToOmnisend($order_id);
    OmnisendManagerAssistant::unsetUserCart(false);
}

/* Hook trigered when admin updates order */
add_action('woocommerce_process_shop_order_meta', 'omnisend_order_updated', 50, 2);
function omnisend_order_updated($order_id)
{
    OmnisendLogger::hook();
    if (is_admin()) {
        OmnisendManager::pushOrderToOmnisend($order_id);
    }
}

/**Fulfillment statuses*/
/*Hook for triggering action when order staus is changed to Processing*/
add_action('woocommerce_order_status_processing', 'omnisend_order_processing', 10, 1);
function omnisend_order_processing($order_id)
{
    OmnisendLogger::hook();
    OmnisendManager::updateOrderStatus($order_id, "fulfillment", "inProgress");
}
/*Hook for triggering action when order staus is changed to Completed*/
add_action('woocommerce_order_status_completed', 'omnisend_order_completed', 10, 1);
function omnisend_order_completed($order_id)
{
    OmnisendLogger::hook();
    OmnisendManager::updateOrderStatus($order_id, "fulfillment", "fulfilled");
}

/**Payment statuses*/
/*Hook for triggering action when order staus is changed to Pending*/
add_action('woocommerce_order_status_pending', 'omnisend_order_pending', 10, 1);
function omnisend_order_pending($order_id)
{
    OmnisendLogger::hook();
    OmnisendManager::updateOrderStatus($order_id, "payment", "awaitingPayment");
}
/*Hook for triggering action when order staus is changed to Cancelled*/
add_action('woocommerce_order_status_cancelled', 'omnisend_order_cancelled', 10, 1);
function omnisend_order_cancelled($order_id)
{
    OmnisendLogger::hook();
    OmnisendManager::updateOrderStatus($order_id, "payment", "voided");
}
/*Hook for triggering action when order staus is changed to Refunded*/
add_action('woocommerce_order_status_refunded', 'omnisend_order_refunded', 10, 1);
function omnisend_order_refunded($order_id)
{
    OmnisendLogger::hook();
    OmnisendManager::updateOrderStatus($order_id, "payment", "refunded");
}
/*Hook for triggering action when order Payment is complete*/
add_action('woocommerce_payment_complete', 'omnisend_order_payment_completed', 10, 1);
function omnisend_order_payment_completed($order_id)
{
    OmnisendLogger::hook();
    OmnisendManager::updateOrderStatus($order_id, "payment", "paid");
}

/*Hook for triggering action when order Payment failed (order status set to Failed)*/
add_action('woocommerce_order_status_failed', 'omnisend_order_payment_failed', 10, 1);
function omnisend_order_payment_failed($order_id)
{
    OmnisendLogger::hook();
    OmnisendManager::updateOrderStatus($order_id, "payment", "awaitingPayment");
}

/** CARTS **/
add_action('woocommerce_after_calculate_totals', 'omnisend_cart_updated', 100, 2);
function omnisend_cart_updated()
{
    OmnisendLogger::hook();
    global $cart_converted;
    if (!$cart_converted) {
        OmnisendManager::pushCartToOmnisend();
    }
}

add_action('woocommerce_cart_item_removed', 'omnisend_cart_delete', 10, 2);
function omnisend_cart_delete()
{
    OmnisendLogger::hook();
    global $cart_converted;
    if (!$cart_converted) {
        if (WC()->cart->is_empty()) {
            OmnisendManager::pushCartToOmnisend();
        }
    }
}

/*Restore cart URL*/
function omisend_restore_cart_page()
{
    if (isset($_REQUEST['action'])) {
        OmnisendLogger::hook();
        if ($_REQUEST['action'] == "restoreCart") {
            omnisendRestoreCart();
        }
    }
}
add_action('wp', 'omisend_restore_cart_page');

/* Identify user after login - save cookie */
function omnisend_wplogin($user_login, $user)
{
    OmnisendLogger::hook();
    OmnisendContactResolver::updateByUserId($user->ID);
}
add_action('wp_login', 'omnisend_wplogin', 10, 2);

/*Add code snippet to the footer, if account ID is setted*/
add_action('wp_footer', function () {
    global $pickerProductSet, $omnisendPluginVersion;

    if (OmnisendHelper::isWooCommercePluginActivated() && OmnisendHelper::checkWpWcCompatibility()) {

        $omnisend_account_id = get_option('omnisend_account_id', null);
        if ($omnisend_account_id !== null) {
?>
            <script type="text/javascript">
                //OMNISEND-SNIPPET-SOURCE-CODE-V1
                window.omnisend = window.omnisend || [];
                omnisend.push(["accountID", "<?php echo get_option('omnisend_account_id', null); ?>"]);
                omnisend.push(["track", "$pageViewed"]);
                ! function() {
                    var e = document.createElement("script");
                    e.type = "text/javascript", e.async = !0, e.src = "<?php echo OMNISEND_SRC; ?>inshop/launcher-v2.js";
                    var t = document.getElementsByTagName("script")[0];
                    t.parentNode.insertBefore(e, t)
                }();
                //platform: woocommerce
                //plugin version: <?php echo $omnisendPluginVersion; ?>
            </script>

            <?php
            if (is_product() && !$pickerProductSet) {
                $pickerProductSet = true;
                OmnisendProduct::productPicker();
            }
        }
    }
});

/*Add verification tag */
add_action('wp_head', function () {
    if (OmnisendHelper::isWooCommercePluginActivated() && OmnisendHelper::checkWpWcCompatibility()) {

        $omnisend_account_id = get_option('omnisend_account_id', null);
        if ($omnisend_account_id !== null) {
            ?>
            <meta name="omnisend-site-verification" content="<?php echo get_option('omnisend_account_id', null); ?>" />

<?php
        }
    }
});

function omnisend_checkbox_custom_checkout_field($checkout)
{
    OmnisendLogger::hook();
    $option = get_option('omnisend_checkout_opt_in_text');

    woocommerce_form_field(
        'omnisend_newsletter_checkbox',
        array(
            'type' => 'checkbox',
            'class' => array('omnisend_newsletter_checkbox_field'),
            'label' => $option,
            'value' => true,
            'default' => 0,
            'required' => false,
        ),
        $checkout->get_value('omnisend_newsletter_checkbox')
    );
}

function omnisend_update_contact_status($order_id)
{
    OmnisendLogger::hook();
    if (isset($_POST['omnisend_newsletter_checkbox']) && $_POST['omnisend_newsletter_checkbox']) {
        add_post_meta($order_id, 'marketing_opt_in_consent', "checkout", true);

        $preparedContact = [
            "identifiers" => [
                [
                    "type" => "email",
                    "id" => $_POST['billing_email'],
                    "channels" => [
                        "email" => [
                            "status" => "subscribed",
                            "statusDate" => date(DATE_ATOM, time())
                        ]
                    ]
                ],
                [
                    "type" => "phone",
                    "id" => $_POST['billing_phone'],

                    "channels" => [
                        "sms" => [
                            "status" => "nonSubscribed",
                            "statusDate" => date(DATE_ATOM, time())
                        ]
                    ]
                ]
            ],
            "tags" => [
                "source: checkout"
            ]
        ];


        $link = OMNISEND_URL . "contacts";
        OmnisendHelper::omnisendApi($link, "POST", $preparedContact);
    }
}

$omnisend_checkout_opt_in_text = get_option('omnisend_checkout_opt_in_text');

if (!empty($omnisend_checkout_opt_in_text)) {
    // Add the checkbox field
    add_action('woocommerce_after_checkout_billing_form', 'omnisend_checkbox_custom_checkout_field');

    // update contact status
    add_action('woocommerce_checkout_update_order_meta', 'omnisend_update_contact_status');
}

function omnisend_plugin_updates()
{
    global $omnisendPluginVersion;
    if (is_admin() && !empty(get_option('omnisend_api_key', null))) {
        $versionDB = get_option('omnisend_plugin_version', '1.0.0');
        $updateInfo = false;

        if (version_compare($versionDB, $omnisendPluginVersion, '<')) {
            OmnisendUpdates::update($versionDB, $omnisendPluginVersion);
            $updateInfo = true;
        }

        if ($versionDB != $omnisendPluginVersion) {
            update_option("omnisend_plugin_version", $omnisendPluginVersion);
            $updateInfo = true;
        }

        if (get_option('omnisend_wp_version', null) != get_bloginfo('version')) {
            $updateInfo = true;
        }

        if ($updateInfo) {
            OmnisendManager::updateAccountInfo();
        }
    }
}

add_action('plugins_loaded', 'omnisend_plugin_updates');
?>