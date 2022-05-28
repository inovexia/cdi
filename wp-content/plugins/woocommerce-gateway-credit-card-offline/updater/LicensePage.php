<?php
/**
 * WPL_OCC_LicensePage class
 * 
 */

if ( ! defined( 'DS' ) ) define( 'DS', DIRECTORY_SEPARATOR );

// class WPL_OCC_LicensePage extends WPL_Page {
class WPL_OCC_LicensePage {

	const slug 				= 'import';

	const ViewExt			= '.php';
	const ViewDir			= '.';
	
	var $message;
	var $messages = array();

	public function __construct() {
		add_action( 'admin_menu', 			array( &$this, 'onWpAdminMenu' ), 99 );

        // add / fix enqueued scripts - only on plugin page
        if  ( ( isset( $_GET['page'] ) ) && ( $_GET['page'] == 'wc_offline_cc') ) {
            add_action( 'wp_print_scripts', array( &$this, 'onWpPrintScripts' ), 99 );
        }
	}
	
	public function onWpAdminMenu() {

		if ( isset($_REQUEST['page']) )
		if ( ( @$_REQUEST['page'] == 'wc_offline_cc' ) || ( @$_REQUEST['page'] == 'wc-settings' )  || ( @$_REQUEST['page'] == 'woocommerce_settings' ) ) {
	        $slug = add_submenu_page('woocommerce', __('Offline Credit Card','wc_offline_cc'), __('Offline Credit Card','wc_offline_cc'), 'manage_woocommerce', 'wc_offline_cc', array(&$this, 'onDisplayLicensePage'));
		}

	}

	public function onDisplayLicensePage() {

        $this->saveLicenseSettings();
        $this->handleUpdateCheck();
        $this->checkLicenseStatus();

        $aData = array(
            // 'plugin_url'                => self::$PLUGIN_URL,
            'message'                   => $this->message,

            'license_key'          => self::getOption( 'license_key' ),
            'license_email'        => self::getOption( 'license_email' ),
            'license_activated'    => self::getOption( 'license_activated' ),
            'update_channel'       => self::getOption( 'update_channel' ),

            'plugin_page'               => 'admin.php?page=wc_offline_cc',
            'form_action'               => 'admin.php?page=wc_offline_cc'
        );
        $this->display( 'license_page', $aData );
	}


    public function onWpPrintScripts() {

        // enqueue tipTip.js 
        wp_register_script( 'jquery-tiptip', WC_OFFLINE_CC_URL . '/js/jquery-tiptip/jquery.tipTip.min.js', array( 'jquery' ), WC_OFFLINE_CC_VERSION, true );
        wp_enqueue_script( 'jquery-tiptip' );

    }

    protected function checkLicenseStatus() {

        // TODO: check nonce
        if ( isset( $_GET['action'] ) && ( $_GET['action'] == 'occ_check_license_status' ) ) {

            global $wc_offline_cc_updater;
            $result = $wc_offline_cc_updater->check_license( self::getOption( 'license_key' ), self::getOption( 'license_email' ) );
            // echo "<pre>";print_r($result);echo"</pre>";die();

            if ( $result === true ) {
                $this->showMessage( __('Your license is currently active on this site.','wc_offline_cc') );
                self::updateOption( 'license_activated', '1' );

            } elseif ( is_object($result) && (!is_wp_error($result)) && ( $result->code == 101 ) ) {
                $this->showMessage( __('This license has not been activated on this site.','wc_offline_cc') );
                $this->showMessage( __('The update server responded:','wc_offline_cc')
                                    . '<br>Error #'.$result->code.': '. $result->error, 1 );
                self::updateOption( 'license_activated', '0' );

            } elseif ( is_wp_error( $result ) ) {
                $error_string  = $result->get_error_message();
                $error_string .= $result->get_error_data();
                $this->showMessage( __('There was a problem checking your license.','wc_offline_cc')
                                    . ' (1)<br>' . $error_string, 1 );
            } elseif ( is_object($result) ) {
                $this->showMessage( __('There was a problem checking your license.','wc_offline_cc')
                                    . ' (2)<br>Error #'.$result->code.': '. $result->error, 1 );
            } else {
                $this->showMessage( __('There was a problem checking your license.','wc_offline_cc')
                                    . ' (3)<br>Error: '.$result, 1 );
            }                   

        }

    } // checkLicenseStatus()

    protected function handleUpdateCheck() {

        // force wp update check
        if ( @$_GET['action'] == 'force_update_check' ) {              

            // global $wpdb;
            // $wpdb->query("update wp_options set option_value='' where option_name='_site_transient_update_plugins'");
            set_site_transient('update_plugins', null);

            $this->showMessage( 
                __('Check for updates was initiated.','wc_offline_cc') . ' '
                . __('You can visit your WordPress Updates now.','wc_offline_cc') . '<br><br>'
                . __('Since the updater runs in the background, it might take a little while before new updates appear.','wc_offline_cc') . '<br><br>'
                . '&raquo; <a href="update-core.php">'.__('view updates','wc_offline_cc') . '</a>'
            );
        }

    }

    protected function saveLicenseSettings() {

        // TODO: check nonce
        if ( isset( $_POST['wc_offline_cc_license_key'] ) ) {

            // new license key or email ?
            $oldLicense = self::getOption( 'license_key' );
            $oldEmail   = self::getOption( 'license_email' );
            if ( $oldLicense != $this->getValueFromPost( 'license_key' ) ) {
                self::updateOption( 'license_activated', '0' );
            }
            if ( $oldEmail != $this->getValueFromPost( 'license_email' ) ) {
                self::updateOption( 'license_activated', '0' );
            }

            // license activated ?  
            if ( self::getOption( 'license_activated' ) != '1' ) {
                global $wc_offline_cc_updater;
                if ( is_object( $wc_offline_cc_updater ) ) { // skip if no updater included
                    $result = $wc_offline_cc_updater->activate_license( $this->getValueFromPost( 'license_key' ), $this->getValueFromPost( 'license_email' ) );
                    if ( $result === true ) {
                        $this->showMessage( __('Your license was activated.','wc_offline_cc') );
                        self::updateOption( 'license_activated', '1' );
                    } elseif ( is_wp_error( $result ) ) {
                        $error_string  = $result->get_error_message();
                        $error_string .= $result->get_error_data();
                        $this->showMessage( __('There was a problem activating your license.','wc_offline_cc')
                                            . '<br>' . $error_string, 1 );
                    } elseif ( is_object($result) ) {
                        $this->showMessage( __('There was a problem activating your license.','wc_offline_cc')
                                            . '<br>Error #'.$result->code.': '. $result->error, 1 );
                    } else {
                        $this->showMessage( __('There was a problem activating your license.','wc_offline_cc')
                                            . '<br>Error #'.$result, 1 );
                    }                   
                }
            }

            self::updateOption( 'license_key',      $this->getValueFromPost( 'license_key' ) );
            self::updateOption( 'license_email',    $this->getValueFromPost( 'license_email' ) );
            self::updateOption( 'update_channel',   $this->getValueFromPost( 'update_channel' ) );
            // $this->showMessage( __('License settings updated.','wc_offline_cc') );

            if ( $this->getValueFromPost( 'deactivate_license' ) == '1') {

                global $wc_offline_cc_updater;
                $result = $wc_offline_cc_updater->deactivate_license( self::getOption( 'license_key' ), self::getOption( 'license_email' ) );
                if ( $result === true ) {
                    $this->showMessage( __('Your license was deactivated.','wc_offline_cc') );
                    self::updateOption( 'license_activated', '0' );
                    self::updateOption( 'license_key', '' );
                    self::updateOption( 'license_email', '' );

                } elseif ( is_wp_error( $result ) ) {
                    $error_string  = $result->get_error_message();
                    $error_string .= $result->get_error_data();
                    $this->showMessage( __('There was a problem deactivating your license.','wc_offline_cc')
                                        . '<br>' . $error_string, 1 );
                } elseif ( is_object($result) ) {
                    $this->showMessage( __('There was a problem deactivating your license.','wc_offline_cc')
                                        . '<br>Error #'.$result->code.': '. $result->error, 1 );
                } else {
                    $this->showMessage( __('There was a problem deactivating your license.','wc_offline_cc')
                                        . '<br>Error: '.$result, 1 );
                }                   


            }

        }
    }
    
    public function getOption( $key ) {
        return get_option('wc_offline_cc_'.$key);
    }
    public function updateOption( $key, $value ) {
        update_option('wc_offline_cc_'.$key, $value);
    }
    protected function getValueFromPost( $key ) {
        $key = 'wc_offline_cc_'.$key;
        return ( isset( $_POST[$key] ) ? trim( $_POST[$key] ) : false );
    }
    

	


	/* Generic message display */
	public function showMessage($message, $errormsg = false, $echo = false) {		
		$class = ($errormsg) ? 'error' : 'updated fade';
		$this->message .= '<div id="message" class="'.$class.'"><p>'.$message.'</p></div>';
		if ($echo) echo $this->message;
	}



	// display view
	protected function display( $insView, $inaData = array(), $echo = true ) {
		$sFile = dirname(__FILE__).DS.self::ViewDir.DS.$insView.self::ViewExt;

		if ( !is_file( $sFile ) ) {
			$this->showMessage("View not found: ".$sFile,1,1);
			return false;
		}
		
		if ( count( $inaData ) > 0 ) {
			extract( $inaData, EXTR_PREFIX_ALL, 'wpl' );
		}
		
		ob_start();
			include( $sFile );
			$sContents = ob_get_contents();
		ob_end_clean();

		if ($echo) {
			echo $sContents;
			return true;
		} else {
			return $sContents;
		}
	
	}


}
$WPL_OCC_LicensePage = new WPL_OCC_LicensePage();

