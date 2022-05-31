<?php

/**
 * USER LOGIN AND REGISTRATION FUNCTIONALITIES
 */
// Ajax login functionality initialize scripts
function ajax_login_init() {

    wp_register_script('ajax-login-script', get_template_directory_uri() . '/assets/js/ajax-login-script.js', array('jquery') );
    wp_enqueue_script('ajax-login-script');
    global $wp;
    wp_localize_script( 'ajax-login-script', 'ajax_login_object', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'redirecturl' => home_url( $wp->request ),
        'loadingmessage' => __('Sending user info, please wait...')
    ));

    // Enable the user with no privileges to run ajax_login() in AJAX
    add_action( 'wp_ajax_nopriv_ajaxlogin', 'ajax_login' );
}

// Execute the action only if the user isn't logged in
if ( ! is_user_logged_in()) {
    add_action('init', 'ajax_login_init');
}

// Ajax login functionality callback function
function ajax_login(){

    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-login-nonce', 'security' );

    // Nonce is checked, get the POST data and sign user on
    auth_user_login ($_POST['username'], $_POST['password'], 'Login');

    die();
}

// Ajax login functionality on checkout page
function auth_user_login ($username, $password, $login){

    $info = array();
    $info['user_login'] = $username;
    $info['user_password'] = $password;
    $info['remember'] = true;

    $user_signon = wp_signon( $info, false );
    if ( empty ($username) || empty ($password) ) {
        echo json_encode(array('loggedin'=>false, 'message'=>__('Both username and password are required.')));
    } else if ( is_wp_error($user_signon) ){
        echo json_encode(array('loggedin'=>false, 'message'=>__('Wrong username or password.')));
    } else {
        echo json_encode(array('loggedin'=>true, 'message'=>__('Login successful')));
    }

    die();
}

// Ajax registration functionality on checkout page
function auth_user_registration () {

    // Verify nonce
    if( !isset( $_POST['reg_user_nonce'] ) || !wp_verify_nonce( $_POST['reg_user_nonce'], 'register_user' ) ) {
      //echo json_encode(array('error'=>true, 'message'=>__('Something went wrong, please try again later.')));
    //  die ();
    }

    $current_tab = 0;
    if (isset ($_POST['current_tab'])) {
      $current_tab = $_POST['current_tab'];
    }

    // Validate input fields
    $validation = validate_user_input ($current_tab);
    if ($validation['error'] == true) {
      if (count($validation['message']) > 2) {
        $message = 'Recheck your input and try again';
        $message = $validation['message'];
      } else {
        $message = $validation['message'];
      }
      echo json_encode(array('error'=>true, 'current_tab'=>$current_tab, 'message'=>__($message)));
    } else {
      $info = array();
      $info_meta = array();
      $info['user_nicename'] = $info['nickname'] = $info['display_name'] = $info['first_name'] = sanitize_text_field($_POST['first_name']);
      $info['user_login'] = sanitize_user($_POST['username']) ;
      $info['user_pass'] = sanitize_text_field($_POST['password']);
      $info['user_email'] = sanitize_email( $_POST['email']);

      // Register the user
      if ( ($current_tab > 0 && $current_tab == 4) || $current_tab == 0) {
          $user_id = wp_create_user( $info['user_login'], $info['user_pass'], $info['user_email'] );
          if ( is_wp_error($user_id) ) {
            $error  = $user_id->get_error_codes()	;
            if (in_array('empty_user_login', $error))
              echo json_encode(array('error'=>true, 'current_tab'=>$current_tab, 'message'=>__($user_id->get_error_message('empty_user_login'))));
            elseif(in_array('existing_user_login',$error))
              echo json_encode(array('error'=>true, 'current_tab'=>$current_tab, 'message'=>__('This username is already registered.')));
            elseif(in_array('existing_user_email',$error))
              echo json_encode(array('error'=>true, 'current_tab'=>$current_tab, 'message'=>__('This email address is already registered.')));
          } else {
            // meta-info
            $info_meta['phone'] = sanitize_text_field($_POST['reg_phone']);
            $info_meta['first_name'] = sanitize_text_field($_POST['first_name']);
            $info_meta['middle_name'] = sanitize_text_field($_POST['middle_name']);
            $info_meta['last_name'] = sanitize_text_field($_POST['last_name']);
            $info_meta['billing_address'] = sanitize_text_field($_POST['street_address']);
            $info_meta['billing_address2'] = sanitize_text_field($_POST['app_no']);
            $info_meta['billing_city'] = sanitize_text_field($_POST['city']);
            $info_meta['billing_zipcode'] = sanitize_text_field($_POST['zipcode']);
            $info_meta['billing_country'] = sanitize_text_field($_POST['mspa_country_field']);
            $info_meta['billing_state'] = sanitize_text_field($_POST['mspa_state_field']);
            $info_meta['phone'] = sanitize_text_field($_POST['phone']);
            $info_meta['fax'] = sanitize_text_field($_POST['fax']);
            $info_meta['hear_about_us'] = sanitize_text_field($_POST['hear_about_us']);

            /* Patient Block */
            $info_meta['patient_name'] = sanitize_text_field($_POST['patient_name']);
            $info_meta['patient_dob'] = sanitize_text_field($_POST['patient_dob']);
            $info_meta['patient_gender'] = sanitize_text_field($_POST['patient_gender']);
            $info_meta['patient_species'] = sanitize_text_field($_POST['patient_species']);
            $info_meta['patient_height'] = sanitize_text_field($_POST['patient_height']);
            $info_meta['patient_weight'] = sanitize_text_field($_POST['patient_weight']);
            $info_meta['patient_conditions'] = sanitize_text_field($_POST['patient_conditions']);
            $info_meta['patient_relationship'] = sanitize_text_field($_POST['patient_relationship']);
            $info_meta['patient_conditions'] = sanitize_text_field($_POST['patient_conditions']);
            $info_meta['patient_current_medication'] = sanitize_text_field($_POST['patient_current_medication']);

            /* Doctor's Block */

            /*
            $info_meta['company_name'] = sanitize_text_field($_POST['company_name']);
            $info_meta['contact_name'] = sanitize_text_field($_POST['contact_name']);
            $info_meta['secondary_phone_number'] = sanitize_text_field($_POST['secondary_phone_number']);
            $info_meta['vat_number'] = sanitize_text_field($_POST['vat_number']);
            $info_meta['suit_number'] = sanitize_text_field($_POST['suit_number']);
            $info_meta['license_status'] = sanitize_text_field($_POST['license_status']);
            $info_meta['license_number'] = sanitize_text_field($_POST['license_number']);
            $info_meta['license_expiry'] = sanitize_text_field($_POST['license_expiry']);
            $info_meta['profession'] = sanitize_text_field($_POST['profession']);
            $info_meta['speciality'] = sanitize_text_field($_POST['speciality']);
            $info_meta['medical_professional_name'] = sanitize_text_field($_POST['medical_professional_name']);
            $info_meta['fax'] = sanitize_text_field($_POST['fax']);
            */

            foreach ($info_meta as $key=>$value) {
              update_user_meta( $user_id, $key, $value );
            }

            $user = new WP_User($user_id); // Get the WP_User Object instance from user ID
            $user->set_role('customer');   // Set the WooCommerce "customer" user role

            // Get all WooCommerce emails Objects from WC_Emails Object instance
            $emails = WC()->mailer()->get_emails();

            // Send WooCommerce "Customer New Account" email notification with the password
            $emails['WC_Email_Customer_New_Account']->trigger( $user_id, $info['user_pass'], true );

            /* Send notification to email to new user */
            //wp_new_user_notification( $user_id, null, 'admin' );

            $login['user_login'] = $info['user_login'];
            $login['user_password'] = $info['user_pass'];
            $login['remember'] = true;
            wp_signon( $login, false );
            echo json_encode(array('error'=>false, 'current_tab'=>'finish', 'message'=>__(''), 'redirecturl'=>site_url('')));
          }
      } else {
        echo json_encode(array('error'=>false, 'current_tab'=>$current_tab, 'message'=>__('')));
      }
    }

  die();
}
add_action('wp_ajax_register_user', 'auth_user_registration');
add_action('wp_ajax_nopriv_register_user', 'auth_user_registration');


function validate_user_input ($current_tab=0) {
  $error = false;
  $message = [];

  if (($current_tab > 0 && $current_tab == 1) || $current_tab == 0) {

      if (empty ($_POST['username'])) {
          $error = true;
          array_push ($message, 'Username cannot be empty');
      } else {
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z0-9-' ]*$/",$_POST['username'])) {
          array_push ($message, 'Only letters and white space allowed');
        }
      }

      if (empty ($_POST['email'])) {
          $error = true;
          array_push ($message, 'Email cannot be empty');
      } else if (filter_var ($_POST['email'], FILTER_VALIDATE_EMAIL) == false) {
          $error = true;
          array_push ($message, 'This is not a valid email');
      } else if ($_POST['email'] != $_POST['confirm_email']) {
          $error = true;
          array_push ($message, 'Email and Confirm email are different');
      } else if (email_exists ($_POST['email'])) {
          $error = true;
          array_push ($message, 'An account with this email already exists. Try another email');
      }

      if (empty ($_POST['phone'])) {
          $error = true;
          array_push ($message, 'Phone number is required');
      } elseif (! is_numeric ($_POST['phone'])) {
          $error = true;
          array_push ($message, 'Phone number is not valid');
      }

      if (empty ($_POST['password'])) {
          $error = true;
          array_push ($message, 'Password is required');
      } else if ($_POST['password'] != $_POST['confirm_password']) {
          $error = true;
          array_push ($message, 'Password and Confirm password are different');
      } else {
        $pattern = '/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/';
        if (strlen($_POST['password']) < 8 || !preg_match ($pattern, $_POST['password'])) {
            $error = true;
            array_push ($message, 'Password must be atleast 8 characters and a combination of upper and lower case alphabets, numbers and special symbols');
        }
      }
  }

  if (($current_tab > 0 && $current_tab == 2) || $current_tab == 0) {

      // redeclare message variable
      if ($current_tab > 0) {
        $message = [];
      }

      if (empty ($_POST['first_name'])) {
          $error = true;
          array_push ($message, 'First name cannot be empty');
      }
      if (empty ($_POST['last_name'])) {
          $error = true;
          array_push ($message, 'Last name cannot be empty');
      }
      if (empty ($_POST['street_address'])) {
          $error = true;
          array_push ($message, 'Street address cannot be empty');
      }
      if (empty ($_POST['city'])) {
          $error = true;
          array_push ($message, 'Enter your city');
      }
      if (empty ($_POST['zipcode'])) {
          $error = true;
          array_push ($message, 'Enter a postal code');
      }
      if (empty ($_POST['mspa_country_field'])) {
          $error = true;
          array_push ($message, 'Select your country');
      }
      /* Patient Information */
      if (empty ($_POST['patient_name'])) {
          $error = true;
          array_push ($message, 'Select patient name');
      }
      if (empty ($_POST['patient_dob'])) {
          $error = true;
          array_push ($message, 'Select patient date of birth');
      }
      if (empty ($_POST['patient_gender'])) {
          $error = true;
          array_push ($message, 'Select patient gender');
      }
      if (empty ($_POST['patient_relationship'])) {
          $error = true;
          array_push ($message, 'Select patient relationship');
      }
      if (empty ($_POST['patient_species'])) {
          $error = true;
          array_push ($message, 'Select patient species');
      }
      if (empty ($_POST['patient_height'])) {
          $error = true;
          array_push ($message, 'Select patient height');
      }
      if (empty ($_POST['patient_weight'])) {
          $error = true;
          array_push ($message, 'Select patient weight');
      }
      if (empty ($_POST['patient_conditions'])) {
          $error = true;
          array_push ($message, 'Add patient conditions');
      }
      if (empty ($_POST['patient_drug_allergies'])) {
          $error = true;
          array_push ($message, 'Add patient drug allergies');
      }
      if (empty ($_POST['patient_current_medication'])) {
          $error = true;
          array_push ($message, 'Add patient current medications');
      }
  }

  if (($current_tab > 0 && $current_tab == 3) || $current_tab == 0) {

      // redeclare message variable
      if ($current_tab > 0) {
        $message = [];
      }

      if ($_POST['hear_about_us'] == '0') {
          $error = true;
          array_push ($message, 'Select an option from "How did you hear about us?"');
      }
  }

  if (($current_tab > 0 && $current_tab == 4) || $current_tab == 0) {

      // redeclare message variable
      if ($current_tab > 0) {
        $message = [];
      }

      if (empty ($_POST['terms_condition'])) {
          $error = true;
          array_push ($message, 'You must agree to the terms and conditions');
      }
  }

  $result = ['error'=>$error, 'message'=>$message];
  return $result;
}
