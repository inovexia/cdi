<?php
/*Plugin settings View page*/
function omnisend_show_settings_page() {
    global $omnisendPluginVersion;

    omnisend_handle_settings_page_actions();
?>
<div class="settings-page">
<?php
    displayOmnisendLogo();

    if (OmnisendHelper::isWooCommercePluginActivated()) {
        if (OmnisendHelper::checkWpWcCompatibility()) {
            displaySettings();
        } else { 
            /*If Wordpress version is not supported by Woocommerce - show message*/
            displayUnsupportedWordPressVersion();
        }      
    } else { 
        /*If Woocommerce is not Installed - message with Woocommerce installation link*/
        displayWooCoomerceNotInstalledOrDisabled();
    }

    displayPluginVersion($omnisendPluginVersion);
?>
</div>
<?php
}

function omnisend_handle_settings_page_actions() {
    if (!isset($_POST['action'])) {
        return;
    }

    switch ($_POST['action']) {
        case "omnisend_save_tag":
            $tag = sanitize_text_field($_POST["tag"]);
            
            if ($tag) {
                update_option("omnisend_contact_tag", $tag);
            }
            else {
                delete_option("omnisend_contact_tag");
            }
        break;
        case "omnisend_init_resync":
            OmnisendInitSyncManager::startResyncAllWithErrorOrSkipped();
        break;
        case "omnisend_resync_all_contacts":
            OmnisendInitSyncManager::startResyncContacts();
        break;
        case "omnisend_show_checkout_opt_in":
            $checkout_opt_in = sanitize_text_field($_POST["checkout_opt_in"]);
            
            if ($checkout_opt_in) {
                update_option("omnisend_checkout_opt_in_text", $checkout_opt_in);
            } else {
                delete_option("omnisend_checkout_opt_in_text");
            }
        break;
    }
}

function displayOmnisendLogo() {
?>
<div class="omnisend-logo">
    <a href="http://www.omnisend.com" target="_blank"><img src="<?php echo plugin_dir_url(__FILE__) . 'assets/img/logo.svg'; ?>"></a>
</div>
<?php
}

function displaySettings() {
    $omnisendApiKey = get_option('omnisend_api_key', null);

    if ($omnisendApiKey !== null) {
        if (!OmnisendHelper::arePermalinksCorrect()) {
            displayPermalinkNotice();
        }
        displayApiAccessNotice();
        if (OmnisendHelper::isWooCommerceApiAccessGranted()) {
            displayConnected();
        }
        displayTagSettings();
        displayCheckoutOptInCheckboxSettings();
        displaySyncSettings();
    } else {
        if (get_option('omnisend_initial_sync', null) == null) {
            // Setup initial sync
            OmnisendManagerAssistant::initSync();
            update_option('omnisend_initial_sync', date(DATE_ATOM, time()));
        }
    }

    displayApiKeySettings($omnisendApiKey);
}

function displayConnected() {
?>
<div class="connected"><h3>Your site is connected to Omnisend.</h3></div>
<?php
}

function displayUnsupportedWordPressVersion() {
?>
<div class="settings-section">
    <h2 class="omnisend-warning">Your current WordPress version needs an update to support the latest WooCommerce version.</h2>
</div>
<?php
}

function displayWooCoomerceNotInstalledOrDisabled() {
?>
<div class="settings-section">
    <h2 class="omnisend-warning">Omnisend goes hand-in-hand with WooCommerce. Make sure you have <a href=" <?php echo esc_url(network_admin_url('plugin-install.php?s=woocommerce&tab=search&type=term')); ?>">WooCommerce</a> installed and activated</h2>
</div>
<?php
}

function displayPluginVersion($version) {
?>
<div class="plugin-version"> 
    <p>Omnisend Plugin for Woocommerce - v. <?php echo $version; ?><p>
</div>
<?php
}

?>
