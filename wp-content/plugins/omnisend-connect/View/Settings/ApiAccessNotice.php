<?php

if (!defined('ABSPATH')) {
    exit;
}

function displayApiAccessNotice() {
    if (!OmnisendHelper::isWooCommerceApiAccessGranted()) {
        displayNotice();            
    } else {
        displaySuccess();
    }
}

function displayNotice() {
    $omnisend_account_id = get_option('omnisend_account_id', null);

    if ($omnisend_account_id !== null) {
        $store_url = site_url();
        $endpoint  = '/wc-auth/v1/authorize';
        $callback_url = OMNISEND_CALLBACK_URL;
        $params    = array(
            'app_name'     => OMNISEND_WC_API_APP_NAME,
            'scope'        => 'read_write',
            'user_id'      => get_current_user_id(),
            'return_url'   => $store_url . '/wp-admin/admin.php?page=' . OMNISEND_SETTINGS_PAGE,
            'callback_url' => $callback_url . '/' . $omnisend_account_id
        );

        $full_url = $store_url . $endpoint . '?' . http_build_query( $params );
    }
?>
<div class="notice notice-warning woo-api-access-notice">
    <div class="title">Add Unique discount codes to your emails on Omnisend</div>
    <div class="description">Drive more orders in your online store with Unique discount codes added to your email. <a href="<?php echo OMNISEND_DISCOUNTS_KB_ARTICLE_URL; ?>" target="_blank">Discover how Unique discounts work</a></div>

<?php
    if (OmnisendHelper::arePermalinksCorrect()) {
?>
    <input type="button" value="Enable Unique discounts" class="button button-primary input-button" onclick="location.href='<?php echo $full_url; ?>';">
<?php
    } else {
?>
    <input type="button" value="Enable Unique discounts" class="button button-primary input-button disabled">
<?php
    }
?>
</div>
<?php
}

function displaySuccess() {
    if (empty($_GET["success"])) {
        return;
    }
?>
<div class="notice updated is-dismissible">
    <p>You’re all set. Unique discounts are enabled.</p>
</div>
<?php
}