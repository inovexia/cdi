<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Inovexia_WP_Starter
 */

/**
* Add to cart handler.
*/
add_action( 'wc_ajax_mspa_add_to_cart', 'mspa_ajax_add_to_cart_handler' );
add_action( 'wc_ajax_nopriv_mspa_add_to_cart', 'mspa_ajax_add_to_cart_handler' );
function mspa_ajax_add_to_cart_handler() {

	WC_Form_Handler::add_to_cart_action();
	WC_AJAX::get_refreshed_fragments();

}

// Remove WC Core add to cart handler to prevent double-add
remove_action( 'wp_loaded', array( 'WC_Form_Handler', 'add_to_cart_action' ), 20 );

// Show message after add to cart
add_filter( 'woocommerce_add_to_cart_fragments', 'mspa_ajax_add_to_cart_add_fragments' );
function mspa_ajax_add_to_cart_add_fragments( $fragments ) {
	$all_notices  = WC()->session->get( 'wc_notices', array() );
	$notice_types = apply_filters( 'woocommerce_notice_types', array( 'error', 'success', 'notice' ) );

	ob_start();
	foreach ( $notice_types as $notice_type ) {
		if ( wc_notice_count( $notice_type ) > 0 ) {
			wc_get_template( "notices/{$notice_type}.php", array(
				'notices' => array_filter( $all_notices[ $notice_type ] ),
			) );
		}
	}
	//$fragments['div.woocommerce-notices-wrapper'] = ob_get_clean();
	$fragments['notices_html'] = ob_get_clean();

	wc_clear_notices();

	return $fragments;
}

// Display cart item count
add_filter( 'woocommerce_add_to_cart_fragments', 'header_add_to_cart_fragment', 30, 1 );
function header_add_to_cart_fragment( $fragments ) {
   global $woocommerce;
   ob_start();
   echo $woocommerce->cart->cart_contents_count;
   $fragments['span.cart-items-count'] = ob_get_clean();
   return $fragments;
}

add_filter( 'woocommerce_add_to_cart_fragments', 'wc_mini_cart_refresh_items');
function wc_mini_cart_refresh_items($fragments) {
   ob_start();
   ?>
   <div class="mini-cart-content" >
       <?php woocommerce_mini_cart(); ?>
   </div>
   <?php
   $fragments['div.mini-cart-content'] = ob_get_clean();
   return $fragments;
}

//default sorting rename function
add_filter( 'woocommerce_catalog_orderby', 'mspa_rename_default_sorting_options' );
function mspa_rename_default_sorting_options( $options ){

  $options[ 'menu_order' ] = 'Sort by price'; // rename
  return $options;

}
