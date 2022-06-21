<?php

if (!defined('ABSPATH')) {
    exit;
}

function displayTagSettings() {
    $listID = get_option('omnisend_list_id', null);
    $tag = get_option('omnisend_contact_tag', null);
    
    if ($tag == "" && $listID != "") {
        $list = OmnisendManagerAssistant::getList($listID);
        
        if ($list && array_key_exists("name", $list) && array_key_exists("listID", $list)) {
            $tag = mb_substr($list["name"], 0, 60) . " listid:" . $list["listID"];
            update_option("omnisend_contact_tag", $tag);
        }
    }
?>
<div class="settings-section">
    <div class="logger-section">
        <h3 class="title">Tag settings</h3>
        <p class="title-desc">Assign a tag to contacts that you sync with Omnisend.</p>
        <form method="post">
            <input type="hidden" name="action" value="omnisend_save_tag">
            <input type="text" name="tag" class="regular-text" value="<?php echo $tag; ?>">
            <input type="submit" value="Update tag" class="button button-primary input-button">
        </form>
    </div>
</div>
<?php
}