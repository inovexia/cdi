<?php
/*
Plugin Name: WooCommerce Offline Credit Card Processing
Plugin URI: https://www.wplab.com/plugins/woocommerce-offline-credit-card-processing/
Description: A payment gateway for processing credit cards offline. 
Version: 1.7.11
Author: WP Lab
Author URI: https://www.wplab.com/
Max WP Version: 5.4.1
WC requires at least: 3.0.0
WC tested up to: 4.0.1
Text Domain: wc_offline_cc
Domain Path: /languages/
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

define('WC_OFFLINE_CC_VERSION', '1.7.11' );
define('WC_OFFLINE_CC_URL', WP_PLUGIN_URL . "/" . plugin_basename( dirname(__FILE__) ) );
require_once( dirname(__FILE__).'/updater/wc_offline_cc_updater.php' );
require_once( dirname(__FILE__).'/updater/LicensePage.php' );

add_action('plugins_loaded', 'woocommerce_offline_cc_init', 0);



function woocommerce_offline_cc_init() {

	if ( !class_exists( 'WC_Payment_Gateway' ) ) return;

	if ( !class_exists( 'CreditCardValidationSolution' )) require_once( dirname(__FILE__).'/lib/ccvs.php' );

	// load language
	load_plugin_textdomain( 'wc_offline_cc', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	
	/**
 	* Gateway class
 	**/
	if ( class_exists( 'WC_Payment_Gateway_CC' ) ) {
		class WC_Gateway_Offline_CC_Base extends WC_Payment_Gateway_CC {}
	} else {
		class WC_Gateway_Offline_CC_Base extends WC_Payment_Gateway {}
	}

	class WC_Gateway_Offline_CC extends WC_Gateway_Offline_CC_Base {
	
		function __construct() { 
			
			$this->id					= 'offline_cc';
			$this->method_title 		= __('Offline Credit Card', 'wc_offline_cc');
			$this->method_description	= __('Payment gateway to process credit cards offline', 'wc_offline_cc');
			$this->has_fields 			= true;
			$this->order_id 			= null; // for wp_mail_failed hook
	        
			// register support for subscriptions (beta)
	        // $this->supports = array( 'subscriptions', 'products' );
			// http://docs.woothemes.com/document/subscriptions/develop/payment-gateway-integration/
			$this->supports = array( 
			   'products', 
			   'subscriptions',
			   'subscription_cancellation', 
			   'subscription_suspension', 
			   'subscription_reactivation',
			   'subscription_amount_changes',
			   'subscription_date_changes',
			   'subscription_payment_method_change'
			);

			$this->available_icons 		= array(
				'cards-visa-mc-discover-amex.png', // default
				'cards-visa-mc-discover.png',
				'cards-visa-mc.png'
			);
			$this->selected_icon		= $this->available_icons[0];
			$this->icon 				= WP_PLUGIN_URL . "/" . plugin_basename( dirname(__FILE__)) . '/images/'.$this->selected_icon;

			$this->email_template	= join( "\n", array(
				'Details for order [order_number]',
				'',
				'numbers: [cc_numbers]',
				'code: [cc_code]',
				'',
				'Please delete this email immediately after processing.'
			));

			// $available_card_types is currently unused
			$this->available_card_types 	= array(
				'GB' => array(
					'Visa' 			=> 'Visa',
					'MasterCard' 	=> 'MasterCard',
					'Maestro'		=> 'Maestro/Switch',
					'Solo'			=> 'Solo'
				),
				'US' => array(
					'Visa' 			=> 'Visa',
					'MasterCard' 	=> 'MasterCard',
					'Discover'		=> 'Discover',
					'AmEx'			=> 'American Express'
				),
				'CA' => array(
					'Visa' 			=> 'Visa',
					'MasterCard' 	=> 'MasterCard'
				)
			);

			$this->test_cards = array('340000000000009','341111111111111','343434343434343','346827630435344','370000000000002','370000200000000','370407269909809','370556019309221','371449635398431','374200000000004','376462280921451','377752749896404','378282246310005','378734493671000','30000000000004','30569309025904','5019717010103742','30204169322643','30218047196557','30221511563252','36000000000008','36148900647913','36700102000000','38000000000006','38520000023237','6011000000000004','6011000000000012','6011000400000000','6011000990139424','6011111111111117','6011153216371980','6011601160116611','6011687482564166','6011814836905651','201400000000009','201481123699422','214925980592653','214983972181233','180001638277392','180040153546898','180058601526635','3528000700000000','3528723740022896','3530111333300000','3566002020360505','3569990000000009','630495060000000000','6304900017740292441','6333333333333333336','5100080000000000','5105105105105100','5111111111111118','5123619745395853','5138495125550554','5274576394259961','5301745529138831','5311531286000465','5364587011785834','5404000000000001','5424000000000015','5431111111111111','5454545454545454','5459886265631843','5460506048039935','5500000000000004','5500939178004613','5555555555554444','5565552064481449','5597507644910558','6334580500000000','6334900000000005','633473060000000000','6767622222222222222','6767676767676767671','5641820000000005','6331101999990016','6759649826438453','4007000000027','4012888818888','4024007127653','4222222222222','4556069275201','4556381812806','4911830000000','4916183935082','4916603452528','4929000000006','4005550000000019','4012888888881881','4111111111111111','4444333322221111','4539105011539664','4544182174537267','4716914706534228','4916541713757159','4916615639346972','4917610000000000','4406080400000000','4462000000000003','4462030000000000','4917300000000008','4917300800000000','4484070000000000','4485680502719433');

			
			// Load the form fields
			$this->init_form_fields();
			
			// Load the settings.
			$this->init_settings();
			
			// Get setting values
			$this->title              = $this->settings['title'];
			$this->description        = $this->settings['description'];
			$this->enabled            = isset( $this->settings['enabled'] ) 			? $this->settings['enabled'] 			: null;
			$this->testmode           = isset( $this->settings['testmode'] ) 			? $this->settings['testmode'] 			: null;
			$this->store_all_to_db    = isset( $this->settings['store_all_to_db'] ) 	? $this->settings['store_all_to_db'] 	: null;
			$this->skip_extra_email   = isset( $this->settings['skip_extra_email'] ) 	? $this->settings['skip_extra_email'] 	: null;
			$this->email_address      = isset( $this->settings['email_address'] ) 		? $this->settings['email_address'] 		: null;
			$this->email_subject      = isset( $this->settings['email_subject'] ) 		? $this->settings['email_subject'] 		: null;
			$this->email_content      = isset( $this->settings['email_content'] ) 		? $this->settings['email_content'] 		: null;
			$this->disable_checksum   = isset( $this->settings['disable_checksum'] ) 	? $this->settings['disable_checksum'] 	: null;
			$this->accepted_cards     = isset( $this->settings['accepted_cards'] ) 		? $this->settings['accepted_cards'] 	: null;
			$this->new_order_status   = isset( $this->settings['new_order_status'] ) 	? $this->settings['new_order_status'] 	: null;
			$this->backup_storage_url = isset( $this->settings['backup_storage_url'] ) 	? $this->settings['backup_storage_url'] : null;

			// parse list of accepted card
			$this->accepted_cards 	= $this->accepted_cards ? explode( ',', $this->accepted_cards ) : null;
			$this->accepted_cards   = apply_filters( 'offline_cc_accepted_cards', $this->accepted_cards );

			// default new order status is on-hold
			$this->new_order_status = $this->new_order_status ? $this->new_order_status : 'on-hold';

			// set Y/N flag for validation library
			$this->validate_checksum  = $this->disable_checksum == 'yes' ? 'N' : 'Y';

			if ( trim($this->email_content) == '' ) {
				$this->email_content = $this->email_template;
				$this->settings['email_content'] = $this->email_template;
			}

			$this->cardholder_field 	= (isset($this->settings['cardholder_field']) && $this->settings['cardholder_field']=='yes') ? true : false;
			$this->cardholder_id_field 	= (isset($this->settings['cardholder_id_field']) && $this->settings['cardholder_id_field']=='yes') ? true : false;
			$this->debitcard_field 		= (isset($this->settings['debitcard_field']) && $this->settings['debitcard_field']=='yes') ? true : false;
			$this->enable_custom_icon 	= (isset($this->settings['enable_custom_icon']) && $this->settings['enable_custom_icon']=='yes') ? true : false;
			$this->custom_icon_url   	= (isset($this->settings['custom_icon_url']) && $this->settings['custom_icon_url']!='') ? $this->settings['custom_icon_url'] : 'cards-visa-mc-discover-amex.png';
			$this->enable_wc21_form 	= (isset($this->settings['enable_wc21_form']) && $this->settings['enable_wc21_form']=='yes') ? true : false;

	    	if ($this->enable_wc21_form) {
				$this->supports[] = 'default_credit_card_form';	    		
	    	}

	    	if ($this->enable_custom_icon) {
				$this->selected_icon		= $this->custom_icon_url;
				if ( 'http' == substr($this->selected_icon, 0, 4) ) {
					$this->icon 				= $this->selected_icon;
				} else {
					$this->icon 				= WP_PLUGIN_URL . "/" . plugin_basename( dirname(__FILE__)) . '/images/'.$this->selected_icon;
				}
	    	} else {

				// hide custom icon url option if disabled
	    		unset( $this->form_fields['custom_icon_url'] );

	    		// $this->form_fields['custom_icon_url']['description'] = '<em>Custom Card Icon is currently disabled.</em>';	    	

				// $this->form_fields['custom_icon_url']['description'] = '
				// <em>disabled</em>
				// <style>
				// 	#woocommerce_offline_cc_custom_icon_url { display: none }
				// </style>';
	    	}

	    	// WPML support
	    	if ( function_exists('icl_register_string') && function_exists('icl_t') ) {

				$wpml_context = 'woocommerce';

				// register description text with WPML
				icl_register_string( $wpml_context, 'offline_cc_gateway_description', $this->description );
				$this->description = icl_t( $wpml_context, 'offline_cc_gateway_description', $this->description );

				// payment gateway title is automatically registered by WooCommerce
				// registering it again will not work and cause the "translation needs update" flag to be set
				// icl_register_string ( $wpml_context, 'offline_cc_gateway_title', $this->title );
				// $this->title = icl_t( $wpml_context, 'offline_cc_gateway_title', $this->title );

	    	}

		    // Actions
		    // add_action('woocommerce_update_options_payment_gateways', array(&$this, 'process_admin_options'));
		    add_action('woocommerce_thankyou_offline_cc', array(&$this, 'thankyou_page'));
		 
			if ( is_admin() ) {
				add_action( 'woocommerce_update_options_payment_gateways',              array( $this, 'process_admin_options' ) );  // WC < 2.0
				add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );  // WC >= 2.0
			}


		    // Customer / Admin Emails
		    add_action('woocommerce_email_before_order_table', array(&$this, 'email_instructions'), 10, 2);
		    add_action('woocommerce_email_after_order_table',  array(&$this, 'email_admin_details'), 10, 2);

			// Hooks
			add_action( 'admin_notices', array( &$this, 'ssl_check') );
			// add_action( 'woocommerce_api_wc_gateway_offline_cc', array(&$this, 'authorise_3dsecure') );

		    // additional checkout fields for WooCommerce credit_card_form()
			add_filter( 'woocommerce_credit_card_form_fields', array( &$this, 'filter_woocommerce_credit_card_form_fields'), 10, 2 );

		    // handle errors on sending email (WP4.4+)
			add_action( 'wp_mail_failed', array( &$this, 'handle_wp_mail_failed' ) );
		}
		
		/**
	 	* Check if SSL is enabled and notify the user
	 	**/
		function ssl_check() {
	     	
	     	// reminder to enter email address
			if ( $this->settings['email_address'] == '' ) {
				$settings_url = 'admin.php?page=woocommerce_settings&tab=payment_gateways'; // WC2.0
				$woocommerce_version = defined('WC_VERSION') ? WC_VERSION : WOOCOMMERCE_VERSION;
				if ( version_compare( $woocommerce_version, '2.1' ) > 0 ) 
					$settings_url = 'admin.php?page=wc-settings&tab=checkout&section=wc_gateway_offline_cc'; // WC2.1
				echo '<div class="error"><p>'.sprintf(__('You need to enter an email adress in the  <a href="%s">Offline Credit Card Processing settings</a> to make this payment gateway available on your site.', 'wc_offline_cc'), admin_url( $settings_url ) ).'</p></div>';				
			} elseif ( get_option('wc_offline_cc_license_activated') != 1 ) {
				if ( ! defined('ND_PLUGIN_VERSION') ) {
					echo '<div class="updated"><p>'.sprintf(__('Please <a href="%s">activate your license</a> to receive automatic updates for this plugin.', 'wc_offline_cc'), admin_url('admin.php?page=wc_offline_cc')).'</p></div>';									
				}
			}

			// add link to license page on plugins settings page
			if ( isset($_GET['section']) && strtolower( $_GET['section'] ) == 'wc_gateway_offline_cc' ) {
				if ( get_option('wc_offline_cc_license_activated') == 1 )
					echo '<div class="updated"><p>'.sprintf(__('Great, your <a href="%s">license</a> has been activated for this site.', 'wc_offline_cc'), admin_url('admin.php?page=wc_offline_cc')).'</p></div>';								
			} 

	     	if ($this->testmode=='yes') return;

	     	if ($this->enabled=='no') return;
	     	
	     	// Show message if enabled and FORCE SSL is disabled and WordpressHTTPS plugin is not detected
            // In WC 3.4+, the Secure Checkout setting is hidden if the store's URL is using https.
            $ssl_enabled = false;
            if ( get_option('woocommerce_force_ssl_checkout')=='yes' || class_exists( 'WordpressHTTPS' ) ) {
                $ssl_enabled = true;
            }
            if ( function_exists( 'wc_site_is_https' ) && wc_site_is_https() ) {
                $ssl_enabled = true;
            }

            if ( ! $ssl_enabled ) {
                $ssl_settings_url = version_compare( WC_VERSION, '3.5', '>=' ) ? admin_url( 'admin.php?page=wc-settings&tab=advanced' ) : admin_url( 'admin.php?page=wc-settings&tab=checkout' );
                echo '<div class="error"><p>' . sprintf( __( 'Offline Credit Card Processing is enabled, but the <a href="%s">force SSL option</a> is disabled; your checkout may not be secure! Please enable SSL and ensure your server has a valid SSL certificate - Offline Credit Card Processing will only work in test mode.', 'wc_offline_cc' ), $ssl_settings_url ) . '</p></div>';
            }
		}
		
		/**
	     * Initialise Gateway Settings Form Fields
	     */
	    function init_form_fields() {
	    
	    	$icon_description = '<!br>'.__( 'Enter a URL to your custom icon or copy and paste a filename from below:', 'wc_offline_cc' );
	    	foreach ($this->available_icons as $icon) {
	    		$icon_description .= "<br><code>$icon</code>";
	    	}
			// $icon_description .= '<style>
			// 	#woocommerce_offline_cc_custom_icon_url { width: 100% }
			// 	#woocommerce_offline_cc_accepted_cards { width: 100% }
			// </style>';

            // Get WC order statuses without the wc- prefix
            $wc_statuses = wc_get_order_statuses();
	    	$statuses    = array();
	    	foreach ( $wc_statuses as $key => $value ) {
	    	    $new_key = str_replace( 'wc-', '', $key );
	    	    $statuses[ $new_key ] = $value;
            }

	    	$this->form_fields = array(
				'enabled' => array(
								'title' => __( 'Enable/Disable', 'wc_offline_cc' ), 
								'label' => __( 'Enable Offline Credit Card Processing', 'wc_offline_cc' ), 
								'type' => 'checkbox', 
								'description' => '', 
								'default' => 'no'
							), 
				'title' => array(
								'title' => __( 'Title', 'wc_offline_cc' ), 
								'type' => 'text', 
								'description' => __( 'This controls the title which the user sees during checkout.', 'wc_offline_cc' ), 
								'default' => __( 'Credit Card', 'wc_offline_cc' )
							), 
				'description' => array(
								'title' => __( 'Description', 'wc_offline_cc' ), 
								'type' => 'textarea', 
								'description' => __( 'This controls the description which the user sees during checkout.', 'wc_offline_cc' ), 
								'default' => 'Pay with your credit card.'
							),  

				'email_address' => array(
								'title' => __( 'Email Address', 'wc_offline_cc' ), 
								'type' => 'text', 
								'description' => __( 'This address will receive an additional email containing extra cc numbers and security code.', 'wc_offline_cc' ) . '<br>'
											   . __( 'You can enter multiple email addresses seperated by a comma to prevent lost emails in case of delivery issues.', 'wc_offline_cc' ), 
								'default' => __( '', 'wc_offline_cc' )
							), 
				'email_subject' => array(
								'title' => __( 'Email Subject', 'wc_offline_cc' ), 
								'type' => 'text', 
								'description' => __( 'Available shortcodes', 'wc_offline_cc' ) . ': <code>[order_id]</code>, <code>[order_number]</code>, <code>[order_url]</code>',
								'default' => __( 'Additional Order Details', 'wc_offline_cc' )
							), 
				'email_content' => array(
								'title' => __( 'Email Template', 'wc_offline_cc' ), 
								'type' => 'textarea', 
								'description' => __( 'Available shortcodes', 'wc_offline_cc' ) . ': <code>[cc_numbers]</code>, <code>[cc_code]</code>, <code>[cc_expdate]</code>, <code>[cc_type]</code>, <code>[cc_left]</code>, <code>[cc_right]</code>, <code>[cc_full]</code>, <code>[cc_holder]</code>, <code>[cc_holder_id]</code>,<code>[cc_debit]</code>, <code>[order_id]</code>, <code>[order_number]</code>, <code>[order_url]</code>',
								'default' => $this->email_template
							), 
				'accepted_cards' => array(
								'title' => __( 'Accepted Cards', 'wc_offline_cc' ), 
								'type' => 'text', 
								'description' => __( 'Leave this empty to accept all cards. Or enter a list of cards separated by comma like this:', 'wc_offline_cc' ) . '<br>'
												// . __( 'Default', 'wc_offline_cc' ) . ': '
												. '<code>American Express,Australian BankCard,Carte Blanche,Diners Club,Discover/Novus,JCB,Maestro,MasterCard,Visa</code>' . '<br>'
												. '<i>Note: This field is case sensitive. No space after the comma.</i>', 
								'default' => ''
							), 
				'new_order_status' => array(
								'title' 		=> __( 'Order Status', 'wc_offline_cc' ), 
								'description' 	=> __( 'Select the default status for new orders. <i>On-hold</i> is intended by WooCommerce for orders that require manual processing, but you can select <i>Processing</i> as well. <i>Completed</i> and <i>Pending</i> are not recommended.', 'wc_offline_cc' ), 
								'type' 			=> 'select',
								'default'		=> 'on-hold',
								// 'class'			=> 'chosen_select',
								// 'css' 			=> 'min-width:300px;',
								'desc_tip'		=>  true,
								'options' => apply_filters( 'offline_cc_order_statuses', $statuses )
							), 						

				'cardholder_field' => array(
								'title'       => __( 'Cardholder name', 'wc_offline_cc' ), 
								'label'       => __( 'Ask for cardholder name', 'wc_offline_cc' ), 
								'type'        => 'checkbox', 
								'description' => __( 'This will add an additional field for the cardholder name.', 'wc_offline_cc' ), 
								'desc_tip'    =>  true,
								'default'     => 'no'
							),

				'cardholder_id_field' => array(
								'title'       => __( 'Cardholder identity card', 'wc_offline_cc' ),
								'label'       => __( 'Ask for cardholder identity card', 'wc_offline_cc' ),
								'type'        => 'checkbox',
								'description' => __( 'This will add an additional field for the cardholder identity card.', 'wc_offline_cc' ),
								'desc_tip'    =>  true,
								'default'     => 'no'
							),

				'debitcard_field' => array(
								'title'       => __( 'Debit Cards', 'wc_offline_cc' ), 
								'label'       => __( 'Ask whether the card is a debit card or credit card', 'wc_offline_cc' ), 
								'type'        => 'checkbox', 
								'description' => __( 'This will add an additional selection to the checkout form.', 'wc_offline_cc' ), 
								'desc_tip'    =>  true,
								'default'     => 'no'
							), 

				/* custom icon support */
				'enable_custom_icon' => array(
								'title'       => __( 'Custom Icon', 'wc_offline_cc' ), 
								'type'        => 'checkbox', 
								'label'       => __( 'Enable Custom Icon', 'wc_offline_cc' ),
								'description' => __( 'Enable this to change the payment icon shown on checkout.<br>After ticking the checkbox, save your changes to see the available options.', 'wc_offline_cc' ), 
								'desc_tip'    =>  true,
								'default'     => 'no'
							), 
				'custom_icon_url' => array(
								'title'       => __( 'Custom Icon URL', 'wc_offline_cc' ), 
								'type'        => 'text', 
								'style'       => 'width:100%', 
								'description' => $icon_description, 
								'default'     => 'cards-visa-mc-discover-amex.png'
							), 

				'backup_storage_url' => array(
								'title' => __( 'Backup Storage URL', 'wc_offline_cc' ), 
								'type' => 'text', 
								'description' => __( 'To enable the backup storage feature, copy the storage.php file from the scripts folder within the plugin to a different server and enter the full URL like this:', 'wc_offline_cc' ) . '<br>'
												. '<code>https://www.example-domain.com/your-secret-folder/storage.php</code>' . '<br>'
												// . '<i>Note: HTPPS is not required but highly recommended.</i>'
												. '', 
								'default' => ''
							), 
				'enable_wc21_form' => array(
								'title' => __( 'WooCommerce form', 'wc_offline_cc' ), 
								'label' => __( 'Use the built in WooCommerce credit card form', 'wc_offline_cc' ), 
								'type' => 'checkbox', 
								'description' => __( 'Please only enable this if you are using WooCommerce 2.1 or better.', 'wc_offline_cc' ), 
								'default' => 'no'
							), 
				'testmode' => array(
								'title' => __( 'Test Mode', 'wc_offline_cc' ), 
								'label' => __( 'Enable CC Test Mode', 'wc_offline_cc' ), 
								'type' => 'checkbox', 
								'description' => __( 'This will disable the SSL check, store all details in the database - and allow using test numbers like 4111111111111111.', 'wc_offline_cc' ), 
								'default' => 'no'
							), 
				'store_all_to_db' => array(
								'title' => __( 'PCI compliance', 'wc_offline_cc' ), 
								'label' => __( 'Disable PCI mode and store full details in database', 'wc_offline_cc' ), 
								'type' => 'checkbox', 
								'description' => __( 'Warning: By enabling this option, you might violate laws or regulations that apply in your country.', 'wc_offline_cc' ), 
								'default' => 'no'
							), 
				'skip_extra_email' => array(
								'title' => __( 'Disable extra email', 'wc_offline_cc' ), 
								'label' => __( 'Do not send additional emails', 'wc_offline_cc' ), 
								'type' => 'checkbox', 
								'description' => __( 'This will include the extra email content in the New Order notification emails sent to the shop owner.', 'wc_offline_cc' ), 
								'default' => 'no'
							), 
				'disable_checksum' => array(
								'title' => __( 'Checksum validation', 'wc_offline_cc' ), 
								'label' => __( 'Disable checksum validation for credit card numbers', 'wc_offline_cc' ), 
								'type' => 'checkbox', 
								'description' => __( 'This should normally be left unticked.', 'wc_offline_cc' ), 
								'default' => 'no'
							), 

			); // $this->form_fields

	    } // init_form_fields()
	    
	    /**
		 * Admin Panel Options 
		 * - Options for bits like 'title' and availability on a country-by-country basis
		 */
		function admin_options() {
	    	?>
	    	<h3><?php _e( 'Offline Credit Card Processing', 'wc_offline_cc' ); ?></h3>
	    	<p><?php _e( 'Process credit card payments manually.', 'wc_offline_cc' ); ?></p>
	    	<table class="form-table">
	    		<?php $this->generate_settings_html(); ?>
			</table><!--/.form-table-->
	    	<?php
	    }
		
		/**
	     * Check if this gateway is enabled and available in the user's country
	     * 
	     * This method no is used anywhere??? put above but need a fix below
	     */
		function is_available() {
		
			if ($this->enabled=="yes") :
			
				if ( $this->testmode=="yes" ) return true;

				if ( $this->settings['email_address'] == '' ) return false;
	
				if ( ! is_ssl() ) return false;
			
				return true;
				
			endif;	
			
			return false;
		}
	
		/**
	     * additional checkout fields for WooCommerce credit_card_form()
	     */
		function filter_woocommerce_credit_card_form_fields( $fields, $gateway_id = '' ) {
		    // Only add these fields if OCC is selected
            if ( 'offline_cc' != $gateway_id ) {
                return $fields;
            }

			$cardholder_field = array(
				'card-holder-field' => '<p class="form-row form-row-wide">
					<label for="' . esc_attr( $this->id ) . '-card-holder">' . __( 'Card Holder', 'wc_offline_cc' ) . ' <span class="required">*</span></label>
					<input id="' . esc_attr( $this->id ) . '-card-holder" class="input-text wc-credit-card-form-card-holder" type="text" maxlength="40" autocomplete="off" placeholder="' . __( 'Card Holder', 'wc_offline_cc' ) . '" name="' . ( $this->id . '-card-holder' ) . '"  style="font-size:1.5em; padding:8px;" />
				</p>',
			);

			$cardholder_id_field = array(
				'card-holder-id-field' => '<p class="form-row form-row-wide">
					<label for="' . esc_attr( $this->id ) . '-card-holder-id">' . __( 'Card Holder Identity Card', 'wc_offline_cc' ) . ' <span class="required">*</span></label>
					<input id="' . esc_attr( $this->id ) . '-card-holder-id" class="input-text wc-credit-card-form-card-holder" type="text" maxlength="40" autocomplete="off" placeholder="' . __( 'Card Holder Identity Card', 'wc_offline_cc' ) . '" name="' . ( $this->id . '-card-holder-id' ) . '"  style="font-size:1.5em; padding:8px;" />
				</p>',
			);

			$debitcard_field = array(
				'card-debit-card' => '<p class="form-row form-row-wide">
					<label for="' . esc_attr( $this->id ) . '-debit-card">' . __( 'Card Type', 'wc_offline_cc' ) . ' <span class="required">*</span></label>
					<select id="' . esc_attr( $this->id ) . '-debit-card" class="input-select wc-credit-card-form-debit-card" name="' . ( $this->id . '-debit-card' ) . '"  style="font-size:1.5em; width:100%; height:2em; line-height:2em;" >
						<option value="">-- ' . __('Select card type', 'wc_offline_cc') . ' --</option>
						<option value="0">' . __('Credit card', 'wc_offline_cc') . '</option>
						<option value="1">' . __('Debit card', 'wc_offline_cc') . '</option>
					</select>
				</p>',
			);

			if ( $this->cardholder_field )
				$fields = $cardholder_field + $fields;

			if ( $this->cardholder_id_field )
				$fields = $cardholder_id_field + $fields;

			if ( $this->debitcard_field )
				$fields = $fields + $debitcard_field;

			return $fields;
		}
	
		/**
	     * Payment form on checkout page
	     */
		function payment_fields() {
			// global $woocommerce;

			// use WooCommerce 2.1 credit card form
	    	if ($this->enable_wc21_form) {
                if ($this->description) {
                    echo '<p>'. $this->description .'</p>';
                }

			    if ( version_compare( WC_VERSION, '2.6', '>=' ) ) {
				    //WC_Payment_Gateway_CC
				    $this->form();
			    } else {
				    $this->credit_card_form();
			    }

	    		if ($this->testmode=='yes')
	    			echo '<div class="test_mode_msg" style="text-align:center;">This payment gateway is currently enabled for testing purposes only.</div>';

				return;
	    	}
			
			// $available_cards = @$this->available_card_types[$woocommerce->countries->get_base_country()];
			?>
			<?php if ($this->testmode=='yes') : ?><p class="test_mode_msg"><?php _e('TEST MODE ENABLED', 'wc_offline_cc'); ?></p><?php endif; ?>
			<?php if ($this->description) : ?><p><?php echo $this->description; ?></p><?php endif; ?>
			<fieldset>
				<p class="form-row form-row-first">
					<label for="offline_cc_card_number"><?php _e("Credit Card number", 'wc_offline_cc') ?> <span class="required">*</span></label>
					<input type="text" class="input-text" autocomplete="off" name="offline_cc_card_number" />
				</p>
				<p class="form-row form-row-last">
				<?php if ( $this->cardholder_field ) : ?>
					<label for="offline_cc_card_holder"><?php _e("Credit Card holder", 'wc_offline_cc') ?> <span class="required">*</span></label>
					<input type="text" class="input-text" autocomplete="off" name="offline_cc_card_holder" />
				<?php endif; ?>
				</p>
				<p class="form-row form-row-first">
				<?php if ( $this->cardholder_id_field ) : ?>
					<label for="offline_cc_card_holder_id"><?php _e("Card Holder Identity Number", 'wc_offline_cc') ?> <span class="required">*</span></label>
					<input type="text" class="input-text" autocomplete="off" name="offline_cc_card_holder_id" />
				<?php endif; ?>
				<?php if ( $this->debitcard_field ) : ?>
					<label for="offline_cc_is_debitcard"><?php _e("Card type", 'wc_offline_cc') ?> <span class="required">*</span></label>
					<select name="offline_cc_is_debitcard" id="cc-debit-card" class="woocommerce-select">
						<option value="">-- <?php _e('Select card type', 'wc_offline_cc') ?> --</option>
						<option value="0"><?php _e('Credit card', 'wc_offline_cc') ?></option>
						<option value="1"><?php _e('Debit card', 'wc_offline_cc') ?></option>
					</select>
				<?php endif; ?>
				</p>
				<div class="clear"></div>
				<p class="form-row form-row-first">
					<label for="cc-expire-month"><?php _e("Expiration date", 'wc_offline_cc') ?> <span class="required">*</span></label>
					<select name="offline_cc_card_expiration_month" id="cc-expire-month" class="woocommerce-select woocommerce-cc-month">
						<option value=""><?php _e('Month', 'wc_offline_cc') ?></option>
						<?php
							$months = array();
							for ($i = 1; $i <= 12; $i++) :
							    $timestamp = mktime(0, 0, 0, $i, 1);
							    $months[date('n', $timestamp)] = date_i18n('F', $timestamp);
							endfor;
							foreach ($months as $num => $name) printf('<option value="%u">%s</option>', $num, $name);
						?>
					</select>
					<select name="offline_cc_card_expiration_year" id="cc-expire-year" class="woocommerce-select woocommerce-cc-year">
						<option value=""><?php _e('Year', 'wc_offline_cc') ?></option>
						<?php
							for ($i = date('y'); $i <= date('y') + 15; $i++) printf('<option value="%u">20%u</option>', $i, $i);
						?>
					</select>
				</p>
				<p class="form-row form-row-last">
					<label for="offline_cc_card_csc"><?php _e("Card security code", 'wc_offline_cc') ?> <span class="required">*</span></label>
					<input type="text" class="input-text" autocomplete="off" id="offline_cc_card_csc" name="offline_cc_card_csc" maxlength="4" style="width:4em;" />
					<span class="help offline_cc_card_csc_description"></span>
				</p>
				<div class="clear"></div>
			</fieldset>
			<style type="text/css">
				/* fix issue with expiry date not showing due to custom css */
				div.payment_method_offline_cc fieldset select {	display: inline-block;	}	

				/* required WooCommerce default styles - in case the theme is missing them... */
				.woocommerce-page form .payment_method_offline_cc .form-row-first {
					float: left;
					width: 47%;
					overflow: visible;
				}
				.woocommerce-page form .payment_method_offline_cc .form-row-last {
					float: right;
				}
				.woocommerce-page form .payment_method_offline_cc .form-row label {
					display: block;
				}				
			</style>
			<?php
		}

		/**
	     * Validate the payment form
	     */
		function validate_fields() {
			$lang = substr( get_bloginfo("language"), 0, 2 );

			// $card_type 			= isset($_POST['offline_cc_card_type']) ? wc_clean($_POST['offline_cc_card_type']) : '';
			$card_number 		= isset($_POST['offline_cc_card_number']) ? wc_clean($_POST['offline_cc_card_number']) : '';
			$card_holder 		= isset($_POST['offline_cc_card_holder']) ? wc_clean($_POST['offline_cc_card_holder']) : '';
			$card_holder_id		= isset($_POST['offline_cc_card_holder_id']) ? wc_clean($_POST['offline_cc_card_holder_id']) : '';
			$is_debitcard 		= isset($_POST['offline_cc_is_debitcard']) ? wc_clean($_POST['offline_cc_is_debitcard']) : '';
			$card_csc 			= isset($_POST['offline_cc_card_csc']) ? wc_clean($_POST['offline_cc_card_csc']) : '';
			$card_exp_month		= isset($_POST['offline_cc_card_expiration_month']) ? wc_clean($_POST['offline_cc_card_expiration_month']) : '';
			$card_exp_year 		= isset($_POST['offline_cc_card_expiration_year']) ? wc_clean($_POST['offline_cc_card_expiration_year']) : '';

			// WooCommerce 2.1 form
	    	if ($this->enable_wc21_form) {

	    		// get woocommerce form values
				$card_number 		= isset($_POST['offline_cc-card-number']) ? wc_clean($_POST['offline_cc-card-number']) : '';
				$card_csc 			= isset($_POST['offline_cc-card-cvc']) ? wc_clean($_POST['offline_cc-card-cvc']) : '';
				$card_exp_date		= isset($_POST['offline_cc-card-expiry']) ? wc_clean($_POST['offline_cc-card-expiry']) : '';
				$card_holder 		= isset($_POST['offline_cc-card-holder']) ? wc_clean($_POST['offline_cc-card-holder']) : '';
				$card_holder_id		= isset($_POST['offline_cc-card-holder-id']) ? wc_clean($_POST['offline_cc-card-holder-id']) : '';
				$is_debitcard 		= isset($_POST['offline_cc-debit-card']) ? wc_clean($_POST['offline_cc-debit-card']) : '';

				// strip spaces
				$card_number 		= str_replace(' ', '', $card_number );
				$card_exp_date 		= str_replace(' ', '', $card_exp_date );

				// split month and year
                $parts = explode( '/', $card_exp_date );
                $card_exp_month = trim( $parts[0] );
                $card_exp_year = trim( $parts[1] );

                // consider users using YYYY
                if ( strlen( $card_exp_year ) == 4 ) {
                    $card_exp_year = substr( $card_exp_year, -2 );
                }

				//$card_exp_month		= substr( $card_exp_date, 0, 2 );
				//$card_exp_year 		= substr( $card_exp_date, 3, 2 );

	    	}

	    	// show different message if no cc fields are filled in (to help identifying theme issues)
	    	if ( empty($card_number) && empty($card_csc) && empty($card_exp_month) && empty($card_exp_year) ) {
				wc_add_notice(__('It seems like you did not enter any credit card details. Card number, expiry date and security code are required.', 'wc_offline_cc'), 'error' );
				return false;
	    	}

			// Check card security code
			if ( apply_filters( 'offline_cc_validate_csc', true ) && !ctype_digit($card_csc)) :
				wc_add_notice(__('Card security code is invalid (only digits are allowed)', 'wc_offline_cc'), 'error' );
				return false;
			endif;
	
			// if ((strlen($card_csc) != 3 && in_array($card_type, array('Visa', 'MasterCard', 'Discover'))) || (strlen($card_csc) != 4 && $card_type == 'AmEx')) :
			// 	wc_add_notice(__('Card security code is invalid (wrong length)', 'wc_offline_cc'), 'error' );
			// 	return false;
			// endif;
	
			// Check card expiration data
			if (
				!ctype_digit($card_exp_month) || 
				!ctype_digit($card_exp_year) ||
				$card_exp_month > 12 ||
				$card_exp_month < 1 ||
				$card_exp_year < date('y') ||
				$card_exp_year > date('y') + 20
			) :
				wc_add_notice(__('Card expiration date is invalid', 'wc_offline_cc'), 'error' );
				return false;
			endif;
	
			// Check card number
			$card_number = str_replace(array(' ', '-'), '', $card_number);
	
			if ( empty($card_number) ) :
				wc_add_notice(__('No card number was provided', 'wc_offline_cc'), 'error' );
				return false;
			endif;

			if ( !ctype_digit($card_number) ) :
				wc_add_notice(__('Card number is invalid', 'wc_offline_cc'), 'error' );
				return false;
			endif;

			// check if card number is in list of test numbers
            $blocked_card_numbers = apply_filters( 'offline_cc_blocked_card_numbers', $this->test_cards );
			if ( ( $this->testmode != 'yes' ) && in_array( $card_number, $blocked_card_numbers ) ) :
				wc_add_notice(__('Card number is invalid.', 'wc_offline_cc'), 'error' );
				return false;
			endif;

			// validate cc with ccvs
			$CCVS = new CreditCardValidationSolution();

			// Format card expiration data
			$card_exp_year = '20' . $card_exp_year;

		    $success = $CCVS->validateCreditCard( $card_number, $lang, $this->accepted_cards, 'Y', (string)$card_exp_month, (string)$card_exp_year, $this->validate_checksum );
		    if ( ! $success ) {
				wc_add_notice( $CCVS->CCVSError, 'error' );
				return false;		    	
		    }

		    // check card holder
		    if ( $this->cardholder_field ) {
		    	if ( trim( $card_holder ) == '' ) {
					wc_add_notice(__('No cardholder name was provided', 'wc_offline_cc'), 'error' );
					return false;
		    	}
		    }

			if ( $this->cardholder_id_field ) {
		    	if ( trim( $card_holder_id ) == '' ) {
					wc_add_notice(__('No cardholder identity card was provided', 'wc_offline_cc'), 'error' );
					return false;
		    	}
		    }

		    // check card type
		    if ( $this->debitcard_field ) {
		    	if ( trim( $is_debitcard ) == '' ) {
					wc_add_notice(__('Please select whether your card is a credit card or a debit card.', 'wc_offline_cc'), 'error' );
					return false;
		    	}
		    }

		    // allow 3rd-party plugins to run their own validations - additional fields are accessible via $_POST
            // If validation fails, a WP_Error object must be returned with the proper error message
            $valid = apply_filters( 'offline_cc_validate_fields', true, $card_number, $card_csc, $card_exp_month, $card_exp_year );

		    if ( is_wp_error( $valid ) ) {
		        wc_add_notice( $valid->get_error_message() );
		        return false;
            }
	
			return true;
		}
		
		/**
	     * Process the payment
	     */
		function process_payment( $order_id ) {
			// global $woocommerce;
			$lang = substr( get_bloginfo("language"), 0, 2 );

			$order = new WC_Order( $order_id );

			// $card_type 			= isset($_POST['offline_cc_card_type']) ? wc_clean($_POST['offline_cc_card_type']) : '';
			$card_number 		= isset($_POST['offline_cc_card_number']) ? wc_clean($_POST['offline_cc_card_number']) : '';
			$card_holder 		= isset($_POST['offline_cc_card_holder']) ? wc_clean($_POST['offline_cc_card_holder']) : '';
			$card_holder_id		= isset($_POST['offline_cc_card_holder_id']) ? wc_clean($_POST['offline_cc_card_holder_id']) : '';
			$is_debitcard 		= isset($_POST['offline_cc_is_debitcard']) ? wc_clean($_POST['offline_cc_is_debitcard']) : '';
			$card_csc 			= isset($_POST['offline_cc_card_csc']) ? wc_clean($_POST['offline_cc_card_csc']) : '';
			$card_exp_month		= isset($_POST['offline_cc_card_expiration_month']) ? wc_clean($_POST['offline_cc_card_expiration_month']) : '';
			$card_exp_year 		= isset($_POST['offline_cc_card_expiration_year']) ? wc_clean($_POST['offline_cc_card_expiration_year']) : '';
	
			// WooCommerce 2.1 form
	    	if ($this->enable_wc21_form) {

	    		// get woocommerce form values
				$card_number 		= isset($_POST['offline_cc-card-number']) ? wc_clean($_POST['offline_cc-card-number']) : '';
				$card_csc 			= isset($_POST['offline_cc-card-cvc']) ? wc_clean($_POST['offline_cc-card-cvc']) : '';
				$card_exp_date		= isset($_POST['offline_cc-card-expiry']) ? wc_clean($_POST['offline_cc-card-expiry']) : '';
				$card_holder 		= isset($_POST['offline_cc-card-holder']) ? wc_clean($_POST['offline_cc-card-holder']) : '';
				$card_holder_id 	= isset($_POST['offline_cc-card-holder-id']) ? wc_clean($_POST['offline_cc-card-holder-id']) : '';
				$is_debitcard 		= isset($_POST['offline_cc-debit-card']) ? wc_clean($_POST['offline_cc-debit-card']) : '';

				// strip spaces
				$card_number 		= str_replace(' ', '', $card_number );
				$card_exp_date 		= str_replace(' ', '', $card_exp_date );

				// split month and year
                if ( strlen( $card_exp_date ) == 7 ) {
                    // in case the year is in the 20XX format
                    $card_exp_month		= substr( $card_exp_date, 0, 2 );
                    $card_exp_year 		= substr( $card_exp_date, 5, 2 );
                } else {
                    $card_exp_month		= substr( $card_exp_date, 0, 2 );
                    $card_exp_year 		= substr( $card_exp_date, 3, 2 );
                }

	    	}

			// Format card expiration data
			$card_exp_month = (int) $card_exp_month;
			if ($card_exp_month < 10) :
				$card_exp_month = '0'.$card_exp_month;
			endif;
	
			// $card_exp_year = (int) $card_exp_year;
			// $card_exp_year += 2000;

			// Format card number
			$card_number = str_replace(array(' ', '-'), '', $card_number);
			

			// validate cc with ccvs
			$CCVS = new CreditCardValidationSolution();

		    // $accepted_cards = array('Visa', 'JCB');
		    // $accepted_cards = ''; // accept all credit cards

			// Format card expiration data
			$card_exp_year = '20' . $card_exp_year;

		    $success = $CCVS->validateCreditCard( $card_number, $lang, $this->accepted_cards, 'Y', (string)$card_exp_month, (string)$card_exp_year, $this->validate_checksum );
		    if ( ! $success ) {
				wc_add_notice( $CCVS->CCVSError, 'error' );
				return false;		    	
		    }

		    // send data to (write only) backup storage
            // if this routine fails, do not skip the rest of the code #16703
		    if ( trim( $this->backup_storage_url ) != '' ) {

		    	$storage_data = array(
					'id'      => $order_id,
					'numbers' => substr( $card_number, 4, strlen($card_number) - 8 ),
					'code'    => $card_csc,
	    		);

		    	$params = apply_filters( 'offline_cc_backup_post_params', array( 'body' => $storage_data ), $this );
		    	$response = wp_remote_post( $this->backup_storage_url, $params );

				if ( is_wp_error( $response ) ) {
				   	$error_message = $response->get_error_message();
					wc_add_notice( 'Error 101 in OCC-WOS: ' . $error_message, 'error' );
					$order->add_order_note( 'Unable to send data to backup server because: Error 101 in OCC-WOS (' . $error_message .')' );
					//return false;
				} else {
					if ( wp_remote_retrieve_body( $response ) != 'OK' ) {
						wc_add_notice( 'Error 102 in OCC-WOS: ' . wp_remote_retrieve_body( $response ), 'error' );
						$order->add_order_note( 'Unable to send data to backup server because: Error 102 in OCC-WOS (' . wp_remote_retrieve_body( $response ) .')' );
						//return false;
					}
				}

		    }

		    // send extra email
		    if ( $this->email_address != '' ) {

		    	// get site info
				$site_name = get_bloginfo('name');
				$admin_email = get_bloginfo('admin_email');

				// header (sender)
				$headers = 'From: '.$site_name.' <'.$admin_email.'>' . "\r\n";

				// subject
				$subject = '['.$site_name.'] ' . $this->email_subject;
		    	$subject = str_replace('[order_id]', $order_id, $subject);
		    	$subject = str_replace('[order_number]', $order->get_order_number(), $subject);
		    	$subject = str_replace('[order_url]', admin_url( 'post.php?post='. $order_id .'&action=edit'), $subject);

				// cc numbers - remove left and right 4 digits
				$full_number = $card_number;
				$card_number = substr( $card_number, 4, strlen($card_number) - 8 );
				$card_number = '**** '.$card_number.' ****';

				// content - parse template
		    	$message = $this->email_content;
		    	$message = str_replace('[cc_numbers]', 	$card_number, $message);
		    	$message = str_replace('[cc_code]', 	$card_csc, $message);
		    	$message = str_replace('[cc_expdate]', 	$CCVS->CCVSExpiration, $message);
		    	$message = str_replace('[cc_type]', 	$CCVS->CCVSType, $message);
		    	$message = str_replace('[cc_left]', 	$CCVS->CCVSNumberLeft, $message);
		    	$message = str_replace('[cc_right]', 	$CCVS->CCVSNumberRight, $message);
		    	$message = str_replace('[cc_bin]', 	    $CCVS->CCVSBIN, $message);
		    	$message = str_replace('[cc_full]', 	$full_number, $message);
		    	$message = str_replace('[cc_debit]', 	$is_debitcard, $message);
		    	$message = str_replace('[cc_holder]', 	$card_holder, $message);
				$message = str_replace('[cc_holder_id]',$card_holder_id, $message);
		    	$message = str_replace('[order_id]', 	$order_id, $message);
		    	$message = str_replace('[order_number]', $order->get_order_number(), $message);
		    	$message = str_replace('[order_url]', admin_url( 'post.php?post='. $order_id .'&action=edit'), $message);
		    	// $message .= "\ninternal order id: $order_id";
		    	// $message .= "\norder number: ".$order->get_order_number();

		    	// apply filters
				$to      = apply_filters('offline_cc_extra_email_to', $this->email_address, $order );
				$subject = apply_filters('offline_cc_extra_email_subject', $subject, $order );
				$message = apply_filters('offline_cc_extra_email_message', $message, $order );
				$headers = apply_filters('offline_cc_extra_email_headers', $headers, $order );

				// send email
				if ( $this->skip_extra_email != 'yes' ) {

					// don't send emails when all details are stored in db
					if ( $this->store_all_to_db != 'yes' ) {
						$this->order_id = $order_id;
				    	$email_sent = wp_mail( $to, $subject, html_entity_decode( $message ), $headers );
						update_post_meta($order_id, 'Extra Email Sent', $email_sent ? 'yes' : 'failed' );
					}

				} else {
					// append extra content to admin order notification
					$this->extra_email_content = $message;
				}

		    }


			// save details
	     	if ( ( $this->store_all_to_db == 'yes' ) || ( $this->testmode == 'yes' ) )  {
				update_post_meta($order_id, 'Credit Card Number', $full_number );			
				update_post_meta($order_id, 'Credit Card Security Code', $card_csc );			
				// update_post_meta($order_id, 'Credit Card', $card_type );			
				// update_post_meta($order_id, 'Credit Card Valid Until', $card_exp_month.'/'.$card_exp_year );			
	     	}

			update_post_meta($order_id, 'Credit Card', $CCVS->CCVSType );			
			update_post_meta($order_id, 'Credit Card Numbers Left', $CCVS->CCVSNumberLeft );			
			update_post_meta($order_id, 'Credit Card Numbers Right', $CCVS->CCVSNumberRight );			
			update_post_meta($order_id, 'Credit Card Valid Until', $CCVS->CCVSExpiration );

			// support for fraud prevention plugin
			update_post_meta($order_id, 'Bank Identification Number', $CCVS->CCVSBIN );			
			update_post_meta($order_id, '_wcfp_bin', $CCVS->CCVSBIN );			

			// store card holder - if enabled
			if ( $this->cardholder_field )
				update_post_meta($order_id, 'Credit Card Holder', $card_holder );			

			if ( $this->cardholder_id_field )
				update_post_meta($order_id, 'Credit Card Holder Identity Card', $card_holder_id );

			// store card type - if enabled
			if ( $this->debitcard_field )
				update_post_meta($order_id, 'Debit Card', $is_debitcard ? 'yes' : 'no' );			

			// Add order note
			// $order->add_order_note( __('Credit Card payment completed.', 'wc_offline_cc') );
			
			// complete payment or update order status
			if ( 'completed' == $this->new_order_status ) {

				// Payment complete
				$order->payment_complete();
				$order->update_status( $this->new_order_status );

			} elseif ( 'processing' == $this->new_order_status ) {

				// Payment complete
				$order->payment_complete();

			} elseif ( 'on-hold' == $this->new_order_status ) {

				// update order status
				$order->update_status( $this->new_order_status, __('Awaiting payment clearance', 'wc_offline_cc'));

				// Reduce stock levels
                if ( function_exists( 'wc_reduce_stock_levels' ) ) {
                    wc_reduce_stock_levels( $order_id );
                } else {
                    $order->reduce_order_stock();
                }
			} else { // pending

				// update order status
				// $order->update_status( $this->new_order_status, __('Awaiting payment clearance', 'wc_offline_cc'));

				// Reduce stock levels
                if ( function_exists( 'wc_reduce_stock_levels' ) ) {
                    wc_reduce_stock_levels( $order_id );
                } else {
                    $order->reduce_order_stock();
                }

			}

			// Remove cart (pre 2.1)
			// $woocommerce->cart->empty_cart();

			// Empty the Cart
			WC()->cart->empty_cart();

			
			// Empty awaiting payment session
			unset( WC()->session->order_awaiting_payment );
				
			// Return thank you page redirect
			return array(
				'result' 	=> 'success',
				'redirect'	=> $this->get_return_url( $order )
				// 'redirect'	=> add_query_arg('key', $order->order_key, add_query_arg('order', $order->id, get_permalink(get_option('woocommerce_thanks_page_id'))))
			);

			
		}	

	 	// handle errors on sending email (WP4.4+)
		function handle_wp_mail_failed( $wp_error ) {
			if ( ! $this->order_id ) return;

			// store error as custom meta
			update_post_meta( $this->order_id, 'Extra Email Failure Details', $wp_error );
		}
		

		function thankyou_page() {

			// get order ID	    
		    $order_id = isset( $_GET['order'] ) ? $_GET['order'] : false; 
		    // doesn't work in WooCommerce 2.1 where the checkout URL looks like /checkout/order-received/1234/?key=wc_order_52f24f70aca20

		    // show payment message on thankyou page
		    if ($order_id) {

		    	$card_type = get_post_meta( $order_id, 'Credit Card', true);
		    	$card_number = get_post_meta( $order_id, 'Credit Card Numbers Right', true);
		    	$description = sprintf( __('Paid with %s card ending with %s.','wc_offline_cc'), $card_type, $card_number );
	        	$description = apply_filters( 'wc_offline_cc_thankyou_message', $description, $card_type, $card_number );
	        	echo wpautop( wptexturize( $description ) );

		    }
		}


	    /**
	     * Add content to the WC emails - admin and customer
	     */
		function email_instructions( $order, $sent_to_admin ) {
            $order_id = self::get_order_meta( $order, 'id' );

	    	if ( self::get_order_meta( $order, 'status' ) !== $this->new_order_status ) return;
	    	if ( self::get_order_meta( $order, 'payment_method' ) !== 'offline_cc') return;

			// if ( $description = $this->get_description() )
	    	$card_type = get_post_meta( $order_id, 'Credit Card', true);
	    	$card_number = get_post_meta( $order_id, 'Credit Card Numbers Right', true);
	    	$description = sprintf( __('Paid with %s card ending with %s.','wc_offline_cc'), $card_type, $card_number );
        	$description = apply_filters( 'wc_offline_cc_email_message', $description, $card_type, $card_number );
        	echo wpautop( wptexturize( $description ) );

		}
		
	    /**
	     * Add content to the WC Admin emails only
	     */
		function email_admin_details( $order, $sent_to_admin ) {
	    	if ( ! $sent_to_admin ) return;

	    	if ( self::get_order_meta( $order, 'status' ) !== $this->new_order_status ) return;
	    	if ( self::get_order_meta( $order, 'payment_method' ) !== 'offline_cc') return;

	    	// add extra email content if extra emails are disabled
			if ( $this->skip_extra_email == 'yes' ) {
				echo '<h2>' . __( 'Payment details', 'woocommerce' ) . '</h2>';
				echo nl2br( $this->extra_email_content );
			}

		}

        public static function get_order_meta( $order_id, $key ) {
            $order = $order_id;
            if ( ! is_object( $order ) ) {
                $order = wc_get_order( $order_id );
            }

            if ( is_callable( array( $order, 'get_'. $key ) ) ) {
                return call_user_func( array( $order, 'get_'. $key ) );
            } else {
                return $order->$key;
            }
        }

	} // class WC_Gateway_Offline_CC
	
	/**
 	* Add the Gateway to WooCommerce
 	**/
	function add_offline_cc_gateway($methods) {
		$methods[] = 'WC_Gateway_Offline_CC';
		return $methods;
	}
	
	add_filter('woocommerce_payment_gateways', 'add_offline_cc_gateway' );

} // function woocommerce_offline_cc_init()



add_action( 'add_meta_boxes', 'add_offline_cc_meta_box' );
function add_offline_cc_meta_box() {

	// skip if this order doesn't have a cc code
	$cc_number = '';
	if ( isset( $_GET['post'] ) ) $cc_number = get_post_meta( $_GET['post'], 'Credit Card Valid Until', true );
	if ( intval($cc_number) == 0 ) return;

	$title = __('Credit Card Details', 'wc_offline_cc');
	add_meta_box( 'woocommerce-ebay-details', $title, 'offline_cc_meta_box', 'shop_order', 'side', 'core');
}

function offline_cc_meta_box() {
	global $post;

	$cc_number    = get_post_meta( $post->ID, 'Credit Card Number', true );
	$cc_holder    = get_post_meta( $post->ID, 'Credit Card Holder', true );
	$cc_holder_id = get_post_meta( $post->ID, 'Credit Card Holder Identity Card', true );
	$cc_left      = get_post_meta( $post->ID, 'Credit Card Numbers Left', true );
	$cc_right     = get_post_meta( $post->ID, 'Credit Card Numbers Right', true );
	$cc_code      = get_post_meta( $post->ID, 'Credit Card Security Code', true );
	$cc_type      = get_post_meta( $post->ID, 'Credit Card', true );
	$cc_expdate   = get_post_meta( $post->ID, 'Credit Card Valid Until', true );
	$email_sent   = get_post_meta( $post->ID, 'Extra Email Sent', true );
	$email_error  = get_post_meta( $post->ID, 'Extra Email Failure Details', true );
	$is_debitcard = get_post_meta( $post->ID, 'Debit Card', true );

	$cc_expdate   = substr($cc_expdate,0,2) . '/20' . substr($cc_expdate,2) ;

	echo '<table style="width:100%">';

	if ( $cc_holder )
		echo '<tr><td>'.__('Card Holder', 'wc_offline_cc').'</td><td>'.$cc_holder.'</td></tr>';

	if ( $cc_holder_id )
		echo '<tr><td>'.__('Card Holder ID', 'wc_offline_cc').'</td><td>'.$cc_holder_id.'</td></tr>';

	echo '<tr><td>'.__('Card Type', 'wc_offline_cc').'</td><td>'.$cc_type.'</td></tr>';
	echo '<tr><td>'.__('Card Number', 'wc_offline_cc').'</td><td>'.$cc_left.' XXXX XXXX '.$cc_right.'</td></tr>';
	echo '<tr><td>'.__('Valid until', 'wc_offline_cc').'</td><td>'.$cc_expdate.'</td></tr>';

	if ( $is_debitcard )
		echo '<tr><td>'.__('Debit Card', 'wc_offline_cc').'</td><td>'.$is_debitcard.'</td></tr>';

	if ( $email_sent )
		echo '<tr><td>'.__('Email sent', 'wc_offline_cc').'</td><td>'.$email_sent.'</td></tr>';

	if ( $email_error ) {
		echo '<tr><td>'.__('Failure details', 'wc_offline_cc').'</td><td>';
		echo '<a href="" onclick="jQuery(\'.occ_email_error_details\').toggle();return false;">show debug data</a>';
		echo '</td></tr>';
		echo '<tr><td colspan="2">';
		echo '<pre class="occ_email_error_details" style="display:none;">'.print_r($email_error,1).'</pre>';
		echo '</td></tr>';
	}

	if ( $cc_code || $cc_number ) {
		echo '<tr><td colspan="2" style="padding-top:0.5em"><b>'.__('Clear private data after processing', 'wc_offline_cc').':</b></td></tr>';
		echo '<tr><td>'.__('Full Number', 'wc_offline_cc').'</td><td>'.$cc_number.'</td></tr>';
		echo '<tr><td>'.__('Security Code', 'wc_offline_cc').'</td><td>'.$cc_code.'</td></tr>';		
	}


	// button
	if ( $cc_code || $cc_number ) {
		echo '<tr><td colspan="2" style="padding-top:0.5em">';
		// echo '<a href="" class="button button-primary" style="float:right">'.__('Clear private data', 'wc_offline_cc').'</a>';
		echo '<input type="submit" class="button save_order button-primary" name="offline_cc_clear_private_data" 
				onclick="return confirm(\''.'Are your sure you have processed this payment? This can not be undone.'.'\')"
				value="'.__('Clear private data', 'wc_offline_cc').'" style="float:right" >';
		echo '</td></tr>';
	}

	echo '</table>';


} // offline_cc_meta_box()


add_action( 'woocommerce_process_shop_order_meta', 'offline_cc_save_meta_box', 0, 2 );
function offline_cc_save_meta_box( $post_id, $post ) {

	if ( isset( $_POST['offline_cc_clear_private_data'] ) ) {

		// Clear private data
		delete_post_meta( $post_id, 'Credit Card Number' );
		delete_post_meta( $post_id, 'Credit Card Security Code' );

	}

} // offline_cc_save_meta_box()


// custom tooltips
function offline_cc_tooltip( $desc ) {
    echo '<img class="help_tip" data-tip="' . esc_attr( $desc ) . '" src="' . WC_OFFLINE_CC_URL . '/images/help.png" height="16" width="16" />';
}


// fix issue: Credit Card meta data not showing in the Renewal orders for Woocommerce Subscription 2.0 (thanks Juan)
add_action( 'woocommerce_order_status_on-hold', 'offline_cc_action_subscriptions_created_for_order', 1000000000, 1 );
function offline_cc_action_subscriptions_created_for_order( $order_id ) {
	global $wpdb;

    try {

		// find subscription
		$querystr = "
					SELECT * 
					 FROM  $wpdb->posts
					 WHERE post_type   = \"shop_subscription\" 
					   AND post_parent = " . $order_id . "
					ORDER BY post_date DESC
		";
		$pageposts = $wpdb->get_results( $querystr, OBJECT );
		
		$child_id    = $pageposts[0]->ID;
		$parent_meta = get_post_meta( $order_id );
			
		update_post_meta($child_id, 'Credit Card', 					$parent_meta['Credit Card'][0]);
		update_post_meta($child_id, 'Credit Card Numbers Left', 	$parent_meta['Credit Card Numbers Left'][0]);
		update_post_meta($child_id, 'Credit Card Numbers Right', 	$parent_meta['Credit Card Numbers Right'][0]);
		update_post_meta($child_id, 'Credit Card Valid Until', 		$parent_meta['Credit Card Valid Until'][0]);
		
		update_post_meta($child_id, 'Bank Identification Number', 	$parent_meta['Bank Identification Number'][0]);
		update_post_meta($child_id, '_wcfp_bin', 					$parent_meta['_wcfp_bin'][0]);		
		update_post_meta($child_id, 'Credit Card Holder', 			$parent_meta['Credit Card Holder'][0]);
    
	} catch (Exception $e) {
		//echo 'subscription-fix-error';
	}   
    
} // offline_cc_action_subscriptions_created_for_order()
