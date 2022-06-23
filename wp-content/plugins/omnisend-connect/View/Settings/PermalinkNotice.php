<?php

if (!defined('ABSPATH')) {
    exit;
}

function displayPermalinkNotice() {
    $permalink_settings_url = admin_url( 'options-permalink.php?settings-updated=true' )
?>
<div class="notice notice-warning permalink-notice">
    <p>
        Your site’s permalinks are set to “plain”. Select a different option in your <a href="<?php echo $permalink_settings_url ?>">Wordpress settings</a> to enable the discount codes. <a href="<?php echo OMNISEND_DISCOUNTS_KB_ARTICLE_URL; ?>" target="_blank">Learn how to troubleshoot settings</a>
    </p>
</div>
<?php
}