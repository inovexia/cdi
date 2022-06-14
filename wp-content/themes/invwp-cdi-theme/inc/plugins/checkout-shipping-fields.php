<?php

/**
 * CHECKOUT PAGE FUNCTIONALITIES
*/

// Remove the payment options form from default location
// Add the payment options form under the "Payment" section (tab)
// Important:: you will have to also add the following custom CSS:
// body .woocommerce-checkout-payment { float: none; width: 100%; }

add_filter( 'woocommerce_checkout_fields', 'invwp_remove_fields', 9999 );
function invwp_remove_fields( $woo_checkout_fields_array ) {
	// Remove the billing fields below
	unset( $woo_checkout_fields_array['billing']['billing_address_2'] );
	return $woo_checkout_fields_array;
}


/* Checkout page change fields order */
add_filter("woocommerce_checkout_fields", "mspa_checkout_fields_priority", 1);
function mspa_checkout_fields_priority($fields) {
  $fields['billing']['billing_first_name']['priority'] = 1;
  $fields['billing']['billing_last_name']['priority'] = 2;

  $fields['billing']['billing_country']['priority'] = 3;
  $fields['billing']['billing_state']['priority'] = 4;
  $fields['billing']['billing_city']['priority'] = 5;
  $fields['billing']['billing_postcode']['priority'] = 6;
  $fields['billing']['billing_address_1']['priority'] = 7;

//  $fields['billing']['billing_address_2']['priority'] = 7;
  

  $fields['billing']['billing_email']['priority'] = 10;
  $fields['billing']['billing_phone']['priority'] = 11;

  $fields['billing']['billing_company']['priority'] = 12;
	$fields['billing']['billing_contact_name']['priority'] = 13;

	$fields['billing']['billing_vat_number']['priority'] = 14;
	return $fields;
}

add_filter( 'woocommerce_default_address_fields', 'custom_override_default_locale_fields' );
function custom_override_default_locale_fields( $fields ) {
    $fields['state']['priority'] = 5;
    $fields['address_1']['priority'] = 6;
    return $fields;
}
/* Checkout page change fields layout */
add_filter( 'woocommerce_checkout_fields' , 'mspa_checkout_fields_layout', 1 );
function mspa_checkout_fields_layout ( $fields ) {

		/* Field Layout */
		$fields['billing']['billing_first_name']['class'][0] = 'form-row-first  ';
		$fields['billing']['billing_last_name']['class'][0] = 'form-row-last  ';

    $fields['billing']['billing_country']['class'][0] = 'form-row-wide  ';
    $fields['billing']['billing_state']['class'][0] = 'form-row-wide  ';
	$fields['billing']['billing_city']['class'][0] = 'form-row-first  ';
	$fields['billing']['billing_postcode']['class'][0] = 'form-row-last  ';
		$fields['billing']['billing_address_1']['class'][0] = 'form-row-wide';

		

		$fields['billing']['billing_email']['class'][0] = 'form-row-first  ';
		$fields['billing']['billing_phone']['class'][0] = 'form-row-last  ';

		$fields['billing']['billing_company']['class'][0] = 'form-row-first  ';
		$fields['billing']['billing_contact_name']['class'][0] = 'form-row-last  ';

		$fields['billing']['billing_vat_number']['class'][0] = 'form-row-wide ';

  	return $fields;
}

/* Checkout page change fields placeholder */
add_filter( 'woocommerce_checkout_fields' , 'mspa_checkout_fields_placeholder', 100 );
function mspa_checkout_fields_placeholder ( $fields ) {

  	/* Field Placeholders */
  	$fields['billing']['billing_first_name']['placeholder'] = 'First name';
  	$fields['billing']['billing_last_name']['placeholder'] = 'Last name';
  	$fields['billing']['billing_address_1']['placeholder'] = 'Address/ P.O. box, company name, c/o';
  	$fields['billing']['billing_city']['placeholder'] = 'City';
  	$fields['billing']['billing_postcode']['placeholder'] = 'Zip/ Postal Code';
  	$fields['billing']['billing_state']['placeholder'] = 'State';
  	$fields['billing']['billing_country']['placeholder'] = 'Country';
  	$fields['billing']['billing_company']['placeholder'] = 'Company Name';
  	$fields['billing']['billing_contact_name']['placeholder'] = 'Contact Name';
  	$fields['billing']['billing_phone']['placeholder'] = 'Phone Number';
  	$fields['billing']['billing_vat_number']['placeholder'] = 'VAT number';

  	return $fields;
}

/* Checkout page change fields placeholder */
add_filter( 'woocommerce_checkout_fields' , 'mspa_checkout_fields_labels', 100 );
function mspa_checkout_fields_labels ( $fields ) {

  	/* Field Placeholders */
		$fields['billing']['billing_email']['label'] = '';
  	$fields['billing']['billing_first_name']['label'] = '';
  	$fields['billing']['billing_last_name']['label'] = '';
  	$fields['billing']['billing_address_1']['label'] = '';
  	$fields['billing']['billing_city']['label'] = '';
  	$fields['billing']['billing_postcode']['label'] = '';
  	$fields['billing']['billing_state']['label'] = '';
  	$fields['billing']['billing_country']['label'] = '';
  	$fields['billing']['billing_company']['label'] = '';
  	$fields['billing']['billing_contact_name']['label'] = '';
  	$fields['billing']['billing_phone']['label'] = '';
  	$fields['billing']['billing_vat_number']['label'] = '';

  	return $fields;
}

add_filter('woocommerce_form_field_args','mspa_form_field_args', 10, 3);
function mspa_form_field_args($args, $key, $value) {
	$args['input_class'][] = 'form-control';
	return $args;
}
