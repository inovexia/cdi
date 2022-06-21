<?php

if (!defined('ABSPATH')) {
    exit;
}

function displayCheckoutOptInCheckboxSettings() {
    $checkout_opt_in = get_option('omnisend_checkout_opt_in_text', null);
?>
    <div class="settings-section">
        <div class="logger-section">
            <h3 class="title">Checkout opt-in settings</h3>
            <p class="title-desc">Show opt-in checkbox in the checkout page? ( leave empty to hide checkbox )</p>
            <form method="post">
                <input type="hidden" name="action" value="omnisend_show_checkout_opt_in">
                <input type="text" name="checkout_opt_in" class="regular-text" value="<?php echo $checkout_opt_in; ?>">
                <input type="submit" value="Update Opt-in" class="button button-primary input-button">
            </form>
        </div>
    </div>
<?php
}
