<?php /* inspired by Kaspars Dambis */

class wc_offline_cc_updater {
	
	var $api_url = 'http://update.wplab.de/api/';
	// var $plugin_slug_wp  = 'woocommerce-gateway-credit-card-offline';
	var $plugin_slug_wp  = 'gateway-credit-card-offline';
	var $plugin_slug_api = 'offline-cc';
	var $api_key;
	var $domain;
	
	public function __construct() {
		
		// set plugin slug
		// $this->plugin_slug_wp = basename( WC_BULK_PRICING_PATH );

		// hook into update check
		add_filter( 'pre_set_site_transient_update_plugins', array(&$this,'check_for_plugin_update') );

		// hook into plugin info screen
		if ( isset($_GET['plugin']) && ( $_GET['plugin'] == $this->plugin_slug_api ) ) {
			add_filter( 'plugins_api', array(&$this,'plugin_api_call'), 10, 3 );
		}

	}
		
	public function check_for_plugin_update( $checked_data ) {
		// global $wpl_logger;
		// $wpl_logger->info('checked_data '.print_r( $checked_data,1 ));

		if ( empty( $checked_data->checked ) )
			return $checked_data;

		$request_args = array(
			'slug' => $this->plugin_slug_api,
			// 'version' => $checked_data->checked['woocommerce-gateway-credit-card-offline/gateway-credit-card-offline.php'],
			'version' => WC_OFFLINE_CC_VERSION,
		);

		$request_string = $this->wpl_prepare_request( 'basic_check', $request_args );

		// Start checking for an update
		$raw_response = wp_remote_post( $this->api_url, $request_string );
		
		// $wpl_logger->info('calling '.$this->api_url);
		// $wpl_logger->info('request_string '.print_r( $request_string,1 ));
		// $wpl_logger->info('raw_response '.print_r( $raw_response,1 ));

		if ( !is_wp_error( $raw_response ) && ( wp_remote_retrieve_response_code( $raw_response ) == 200 ) ) {
			
			$response = unserialize( wp_remote_retrieve_body( $raw_response ) );
	
			if ( is_object( $response ) && !empty( $response ) ) {

				// Feed the update data into WP updater
				$checked_data->response['woocommerce-gateway-credit-card-offline/gateway-credit-card-offline.php'] = $response;
			}
		}

		// $wpl_logger->info('check_for_plugin_update('.$this->plugin_slug_wp.'): '.$this->api_url);
		// $wpl_logger->info('raw_response: '.print_r($raw_response,1));
		// $wpl_logger->info('response: '.print_r($response,1));
		// $wpl_logger->info('checked_data: '.print_r($checked_data,1));

		return $checked_data;
	}


	public function plugin_api_call( $def, $action, $args ) {

		if ( @$args->slug != $this->plugin_slug_api )
			return false;

		// Get the current version
		// $plugin_info = get_site_transient( 'update_plugins' );
		// $current_version = ...;
		$args->version = WC_OFFLINE_CC_VERSION;

		$request_string = $this->wpl_prepare_request( $action, $args );

		$request = wp_remote_post( $this->api_url, $request_string );

		if ( is_wp_error( $request ) ) {
			$res = new WP_Error( 'plugins_api_failed', ( 'An Unexpected HTTP Error occurred during the API request.</p> <p><a href="?" onclick="document.location.reload(); return false;">Try again</a>' ), $request->get_error_message() );
		} else {
			$res = unserialize( wp_remote_retrieve_body( $request ) );

			if ( $res === false )
				$res = new WP_Error( 'plugins_api_failed', ( 'An unknown error occurred' ), wp_remote_retrieve_body( $request ) );
		}

		return $res;
	}


	public function wpl_prepare_request( $action, $args, $new_license_key = false ) {
		global $wp_version;

		// set host domain domain
		// $url = parse_url( get_bloginfo( 'url' ) );
		$url = parse_url( get_option( 'home' ) );
		$this->domain = $url['host'];
		
		// set api-key
		$license_key = $new_license_key ? $new_license_key : get_option('wc_offline_cc_license_key');
		$this->api_key = md5( $license_key . $this->domain );
		# debug:
		// $this->api_key = ( $license_key . $this->domain );

		// no license key should result in empty api key
		if ( trim($license_key) == '' ) $this->api_key = 'demo';

		return array(
			'body' => array(
				'action'  => $action,
				'request' => serialize( $args ),
				'domain'  => $this->domain,
				'channel' => get_option('wc_offline_cc_update_channel', 'stable'),
				'api-key' => $this->api_key
			),
			'user-agent' => 'WordPress/' . $wp_version . ' - ' . get_bloginfo( 'url' )
		);
	}

	public function activate_license( $license_key, $email ) {
		global $wp_version;
	
		// Get the current version
		// $plugin_info = get_site_transient( 'update_plugins' );
		// $current_version = ...;

		$request_args = array(
			'slug'        => $this->plugin_slug_api,
			'version'     => WC_OFFLINE_CC_VERSION,
			'email'       => $email,
			'license_key' => $license_key
		);

		$request_string = $this->wpl_prepare_request( 'activate_license', $request_args, $license_key );

		$request = wp_remote_post( $this->api_url, $request_string );
		// echo "<pre>";print_r( $request );echo "</pre>";

		if ( is_wp_error( $request ) ) {
			$error_string = $request->get_error_message();
   			echo '<div id="message" class="error"><p>' . $error_string . '</p></div>';
			print_r( $request );
			$res = new WP_Error( 'activate_license_failed', ( 'An Unexpected HTTP Error occurred during the API request.</p> <p><a href="?" onclick="document.location.reload(); return false;">Try again</a>' ), $request->get_error_message() );
		} else {
			$res = @json_decode( wp_remote_retrieve_body( $request ) );
			// print_r( $res );

			// activation successful
			if ( @$res->activated === true )
				return true;

			if ( $res === false || $res === null )
				$res = new WP_Error( 'activate_license_failed', ( 'An unknown error occurred' ), wp_remote_retrieve_body( $request ) );
		}

		return $res;

	}

	public function deactivate_license( $license_key, $email ) {
		global $wp_version;
	
		// Get the current version
		// $plugin_info = get_site_transient( 'update_plugins' );
		// $current_version = ...;

		$request_args = array(
			'slug'        => $this->plugin_slug_api,
			'version'     => WC_OFFLINE_CC_VERSION,
			'email'       => $email,
			'license_key' => $license_key
		);

		$request_string = $this->wpl_prepare_request( 'deactivate_license', $request_args );

		$request = wp_remote_post( $this->api_url, $request_string );
		// echo "<pre>";print_r( $request );echo "</pre>";

		if ( is_wp_error( $request ) ) {
			$error_string = $request->get_error_message();
   			echo '<div id="message" class="error"><p>' . $error_string . '</p></div>';
			print_r( $request );
			$res = new WP_Error( 'deactivate_license_failed', ( 'An Unexpected HTTP Error occurred during the API request.</p> <p><a href="?" onclick="document.location.reload(); return false;">Try again</a>' ), $request->get_error_message() );
		} else {
			$res = @json_decode( wp_remote_retrieve_body( $request ) );
			// print_r( $res );

			// deactivation successful
			if ( @$res->reset === true )
				return true;

			if ( $res === false || $res === null )
				$res = new WP_Error( 'deactivate_license_failed', ( 'An unknown error occurred' ), wp_remote_retrieve_body( $request ) );
		}

		return $res;

	}

	public function check_license( $license_key, $email ) {
		global $wp_version;
	
		// Get the current version
		// $plugin_info = get_site_transient( 'update_plugins' );
		// $current_version = $plugin_info->checked[$this->plugin_slug .'/'. $this->plugin_slug .'.php'];

		$request_args = array(
			'slug'        => $this->plugin_slug_api,
			'version'     => WC_OFFLINE_CC_VERSION,
			'email'       => $email,
			'license_key' => $license_key
		);

		$request_string = $this->wpl_prepare_request( 'check_license', $request_args, $license_key );

		$request = wp_remote_post( $this->api_url, $request_string );
		// echo "<pre>";print_r( $request );echo "</pre>";

		if ( is_wp_error( $request ) ) {
			$error_string = $request->get_error_message();
   			echo '<div id="message" class="error" style="display:block !important;"><p>' . $error_string . '</p></div>';
			print_r( $request );
			$res = new WP_Error( 'check_license_failed', ( 'An Unexpected HTTP Error occurred during the API request.</p> <p><a href="?" onclick="document.location.reload(); return false;">Try again</a>' ), $request->get_error_message() );
		} else {
			$res = @json_decode( wp_remote_retrieve_body( $request ) );
			// print_r( $res );

			// activation successful
			if ( @$res->success === true )
				return true;

			if ( $res === false || $res === null )
				$res = new WP_Error( 'check_license_failed', __( 'An unknown error occurred','wc_offline_cc' ), wp_remote_retrieve_body( $request ) );
		}

		return $res;

	}

	
}

// instantiate object
$wc_offline_cc_updater = new wc_offline_cc_updater();

