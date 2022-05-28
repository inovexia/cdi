<?php #include_once( dirname(__FILE__).'/common_header.php' ); ?>

<style type="text/css">


    /* general styles for edit pages (edit template, edit profile and settings) */
    .wrap .postbox .inside {
        margin-bottom: 15px;
    }

    .wrap .postbox .inside p.desc {
        font-size: smaller;
        font-style: italic;
        margin-top: 0;
        margin-left: 35%;
    }
    .wrap .postbox .inside p.edit_links {
        margin-top: 0;
        margin-left: 35%;
    }

    .wrap .postbox label.text_label {
        display: block;
        float: left;
        width: 33%;
        margin: 1px;
        padding: 3px;
    }
    .wrap .postbox input.text_input,
    .wrap .postbox textarea,
    .wrap .postbox select.select {
        width: 65%;
        margin-bottom: 5px;
        padding: 3px 8px;
    }
    .wrap .postbox textarea {
        height: 120px;
    }



    /* Tooltips */
    .tips {
        cursor: help;
        text-decoration: none;
    }
    img.tips {
        padding: 5px 0 0 0;
    }

    img.help_tip {
        vertical-align: bottom;
        float: right;
    }

    th img.help_tip {
        float: none;
    }

    /* TipTip CSS - Version 1.2 */
    #tiptip_holder {
        display: none;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 99999;
    }
    #tiptip_holder.tip_top {
        padding-bottom: 5px;
    }
    #tiptip_holder.tip_bottom {
        padding-top: 5px;
    }
    #tiptip_holder.tip_right {
        padding-left: 5px;
    }
    #tiptip_holder.tip_left {
        padding-right: 5px;
    }
    #tiptip_content {
        font-size: 11px;
        color: #fff;
        padding: 4px 8px;
        background: #a2678c;
        border-radius: 3px;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        box-shadow: 1px 1px 3px rgba(0,0,0,0.10);
        -webkit-box-shadow: 1px 1px 3px rgba(0,0,0,0.10);
        -moz-box-shadow: 1px 1px 3px rgba(0,0,0,0.10);
        text-align: center;
    }
    #tiptip_content code {
        background: #855c76;
        padding: 1px;
    }
    #tiptip_arrow, #tiptip_arrow_inner {
        position: absolute;
        border-color: transparent;
        border-style: solid;
        border-width: 6px;
        height: 0;
        width: 0;
    }
    #tiptip_holder.tip_top #tiptip_arrow_inner {
        margin-top: -7px;
        margin-left: -6px;
        border-top-color: #a2678c;
    }

    #tiptip_holder.tip_bottom #tiptip_arrow_inner {
        margin-top: -5px;
        margin-left: -6px;
        border-bottom-color: #a2678c;
    }

    #tiptip_holder.tip_right #tiptip_arrow_inner {
        margin-top: -6px;
        margin-left: -5px;
        border-right-color: #a2678c;
    }

    #tiptip_holder.tip_left #tiptip_arrow_inner {
        margin-top: -6px;
        margin-left: -7px;
        border-left-color: #a2678c;
    }

</style>


<script type="text/javascript">
    
    // on page load
    jQuery( document ).ready( function () {
    
        // init tooltips
        jQuery(".tips, .help_tip").tipTip({
            'attribute' : 'data-tip',
            'maxWidth' : '250px',
            'fadeIn' : 50,
            'fadeOut' : 50,
            'delay' : 200
        });

    });

</script>


<div class="wrap">
	<div class="icon32 woocommerce-billomat-integration" id="wpl-icon"><br /></div>

	<h2><?php echo __('Offline Credit Card Processing - Updates','wc_offline_cc') ?></h2>
    <?php echo $wpl_message ?>


    <div style="width:60%;min-width:640px;" class="postbox-container">
        <div class="metabox-holder">
            <div class="meta-box-sortables ui-sortable">


                <form method="post" action="<?php echo $wpl_form_action; ?>">
                    <input type="hidden" name="action" value="save_wc_offline_cc_license" >

                    <div class="postbox" id="LicenseBox" style="">
                        <h3 class="hndle"><span><?php echo __('License','wc_offline_cc') ?></span></h3>
                        <div class="inside">

                            <label for="wpl-text-license_email" class="text_label">
                                <?php echo __('License email','wc_offline_cc'); ?>
                                <?php offline_cc_tooltip('Your license email is the email address you used for purchasing the plugin.') ?>
                            </label>
                            <input type="text" name="wc_offline_cc_license_email" id="wpl-text-license_email" value="<?php echo $wpl_license_email; ?>" class="text_input" />

                            <label for="wpl-text-license_key" class="text_label">
                                <?php echo __('License key','wc_offline_cc'); ?>
                                <?php offline_cc_tooltip('You can find you license key in your order confirmation email which you have received right after your purchase.<br>If you have lost your license key please visit the <i>Lost License</i> page on wplab.com.') ?>
                            </label>
                            <input type="text" name="wc_offline_cc_license_key" id="wpl-text-license_key" value="<?php echo $wpl_license_key; ?>" class="text_input" />

                            <?php if ( $wpl_license_activated == '1' ) : ?>

                                <label for="wpl-deactivate_license" class="text_label">
                                    <?php echo __('Deactivate license','wc_offline_cc'); ?>
                                    <?php offline_cc_tooltip('You can deactivate your license on this site any time and activate it again on a different site or domain.') ?>
                                </label>
                                <input type="checkbox" name="wc_offline_cc_deactivate_license" id="wpl-deactivate_license" value="1" class="checkbox_input" />
                                <span style="line-height: 24px">
                                    <?php echo __('Yes, I want to deactivate this license for','wc_offline_cc'); ?>
                                    <i><?php echo str_replace( 'http://','', get_bloginfo( 'url' ) ) ?></i>
                                </span>
                                
                            <?php endif; ?>
                        
                        </div>
                    </div>

                    <div class="postbox" id="UpdateSettingsBox">
                        <h3 class="hndle"><span><?php echo __('Beta testers','wc_offline_cc') ?></span></h3>
                        <div class="inside">

                            <p>
                                <?php echo __('If you want to test new features before they are released, select the "beta" channel.','wc_offline_cc'); ?>
                            </p>
                            <label for="wpl-option-update_channel" class="text_label">
                                <?php echo __('Update channel','wc_offline_cc'); ?>
                                <?php offline_cc_tooltip('Please keep in mind that beta versions might have known bugs or experimental features. Unless WP Lab support told you to update to the latest beta version, it is recommended to keep the update chanel set to <i>stable</i>.') ?>
                            </label>
                            <select id="wpl-option-update_channel" name="wc_offline_cc_update_channel" title="Update channel" class=" required-entry select">
                                <option value="stable" <?php if ( $wpl_update_channel == 'stable' ): ?>selected="selected"<?php endif; ?>><?php echo __('stable','wc_offline_cc'); ?></option>
                                <option value="beta" <?php if ( $wpl_update_channel == 'beta' ): ?>selected="selected"<?php endif; ?>><?php echo __('beta','wc_offline_cc'); ?></option>
                            </select>

                        </div>
                    </div>

                    <div class="submit" style="padding-top: 0; float: left;">
                        <a href="<?php echo $wpl_form_action ?>&action=force_update_check" class="button-secondary"><?php echo __('Force update check','wc_offline_cc'); ?></a> 
                    </div>
                    <div class="submit" style="padding-top: 0; float: right;">
                        <a href="<?php echo $wpl_form_action ?>&action=occ_check_license_status" class="button-secondary"><?php echo __('Check license activation','wc_offline_cc'); ?></a> 
                        &nbsp;
                        <input type="submit" value="<?php echo __('Update settings','wc_offline_cc') ?>" name="submit" class="button-primary">
                    </div>
                </form>


            </div>
        </div>
    </div>




</div>

