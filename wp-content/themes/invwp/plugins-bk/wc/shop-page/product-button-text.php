<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Inovexia_WP_Starter
 */


/* Functions to change Read More button text */
add_filter( 'gettext', 'invx_single_readmore_text', 20, 3 );
function invx_single_readmore_text( $translated_text, $text, $domain ) {
  if ( ! is_admin() && $domain === 'woocommerce' && $translated_text === 'Read more') {
    $translated_text = 'View Options';
  }
  return $translated_text;
}


/* Functions to change ADD TO CART button text */
// Single Product
add_filter( 'woocommerce_product_single_add_to_cart_text', 'mspa_single_add_to_cart_text' );
function mspa_single_add_to_cart_text() {
	return __('ADD TO BAG', 'woocommerce'); // Change this to change the text on the Single Product Add to cart button.
}

// Variable Product
add_filter( 'variable_add_to_cart_text', 'mspa_variable_add_to_cart_text' );
function mspa_variable_add_to_cart_text() {
	return 'Select options'; // Change this to change the text on the Variable Product button.
}

// Grouped Product
add_filter( 'grouped_add_to_cart_text', 'mspa_grouped_add_to_cart_text' );
function mspa_grouped_add_to_cart_text() {
	return 'View options'; // Change this to change the text on the Grouped Product button.
}

// External Product
add_filter( 'external_add_to_cart_text', 'mspa_external_add_to_cart_text' );
function mspa_external_add_to_cart_text() {
	return 'Read More'; // Change this to change the text on the External Product button.
}

// Default
add_filter( 'woocommerce_product_add_to_cart_text', 'mspa_add_to_cart_text' );
function mspa_add_to_cart_text($text) {
	return __(strtoupper($text), 'woocommerce'); // Change this to change the text on the Default button.
}
