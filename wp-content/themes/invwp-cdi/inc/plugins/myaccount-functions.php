<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Inovexia_WP_Starter
 */

 /*
  * Step 1. Add Link (Tab) to My Account menu
  */
 add_filter ( 'woocommerce_account_menu_items', 'invx_product_review_link', 40 );
 function invx_product_review_link ( $menu_links ){

 	$menu_links = array_slice( $menu_links, 0, 5, true )
 	+ array( 'product-reviews' => 'Product reviews' )
 	+ array_slice( $menu_links, 5, NULL, true );

 	return $menu_links;

 }

 /*
  * Step 2. Register Permalink Endpoint
  */
 add_action( 'init', 'invx_add_endpoint' );
 function invx_add_endpoint() {

 	add_rewrite_endpoint( 'product-reviews', EP_PAGES );

 }
 /*
  * Step 3. Content for the new page in My Account, woocommerce_account_{ENDPOINT NAME}_endpoint
  */
 add_action( 'woocommerce_account_product-reviews_endpoint', 'invx_my_account_endpoint_content' );
 function invx_my_account_endpoint_content() {

 	// of course you can print dynamic content here, one of the most useful functions here is get_current_user_id()
 	//echo 'Last time you logged in: yesterday from Safari.';
  include( get_template_directory() . '/woocommerce/myaccount/product-review-page.php' );

 }


/* my account tabs rename & remove */
add_filter( 'woocommerce_account_menu_items', 'invx_rename_acc_adress_tab');
function invx_rename_acc_adress_tab( $items ) {
		$items['dashboard'] = 'My account';
		$items['orders'] = 'My orders';
		$items['edit-address'] = 'Address book';
		$items['payment-methods'] = 'Payment methods';
		return $items;
}

add_filter ( 'woocommerce_account_menu_items', 'invx_remove_my_account_links' );
function invx_remove_my_account_links( $menu_links ) {
	unset( $menu_links['downloads'] ); // Disable Downloads
	unset( $menu_links['edit-account'] ); // Remove Account details tab
	unset( $menu_links['customer-logout'] ); // Remove Account details tab
	return $menu_links;
}

add_filter( 'woocommerce_get_script_data', 'invx_strength_meter_settings', 20, 2 );

function invx_strength_meter_settings( $params, $handle  ) {

	if( $handle === 'wc-password-strength-meter' ) {
		$params = array_merge( $params, array(
			'min_password_strength' => 4,
			'i18n_password_error' => 'Do not you want to be protected? Make it stronger!',
			'i18n_password_hint' => 'Yes, I know, it is simple to use the same weak password each time for all websites you use. I\'m sorry, but I won\'t let you do so, just because I care about your account security. Please make your password at least 7 characters long and use a mix of UPPER and lowercase letters, numbers, and symbols (e.g.,  ! " ? $ % ^ & ).'
		) );
	}
	return $params;

}
