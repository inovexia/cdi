<?php
 
if (!defined('ABSPATH')) {
    exit;
}

function displayApiKeySettings($omnisendApiKey) {
?>
<div class="settings-section">
    <div class="api-key-status">
<?php
        if ($omnisendApiKey !== null) {
?>
        <div>
            <h3>API Key settings</h3>
            <p><span><b>Used API KEY:</b> <span><?php echo substr_replace($omnisendApiKey, " ...", -15)  ?></span></p>
            <a class="change_api_key">Use different API key</a>
        </div>
<?php
            $api_dn = "omnisend_dn";
        } else {
?>
        <p>Paste your Omnisend API key aquired from your account:</p>
<?php
            $api_dn = "";
        }
?>
        <div class="api-key-form-wrapper <?php echo $api_dn ?>">
            <form id="api-key-form">
                <input type="text" name="api-key" id="api-key" class="regular-text" placeholder="API key">
                <input type="submit" name="api-key-submit" id="api-key-submit" class="button button-primary input-button" value="Save">
                <div class="spinner omni_loader"></div>
            </form>
            <h4 class="response-message"></h4>
            <p><a href="https://support.omnisend.com/api-documentation/generating-api-key" target="_blank">How to acquire Omnisend API key</a></p>
            <p>
                <ul>
                    <li>If you’re not on Omnisend, you first have to <a href="https://app.omnisend.com/registration" target="_blank">create Omnisend account</a></li>
                    <li>If your current Omnisend account is connected with another site, you need to create a new account</li>
                    <li>To enable <a href="<?php echo OMNISEND_DISCOUNTS_KB_ARTICLE_URL; ?>" target="_blank">Unique discounts</a> and other product updates, you’ll have to provide limited access to the information on your store</li>
                </ul>
            </p>
        </div>
    </div>
</div>
<?php 
}
