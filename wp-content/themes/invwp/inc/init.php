<?php
/**
* Functions which enhance the theme by hooking into WordPress
*
* @package Inovexia_WP_Theme
*/

/**
* Functions which enhance the theme by hooking into WordPress
*
* @package Inovexia_WP_Starter
*/


/**
* Remove existing hook for product pages breadcrumb
* @hooked woocommerce_breadcrumb - 20
**/
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

/**
* Remove product rating stars
**/
remove_action('woocommerce_single_product_summary', 'woocommerce_template_loop_rating', 20, 0);

/**
* Show product rating stars after product title
**/
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10, 0);
add_action ('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 15, 0);

/**
* Remove single product meta information
**/
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40, 0);


/**
* Load theme files.
*/
require get_template_directory() . '/inc/enqueue.php';

/**
* Register widget areas.
*/
require get_template_directory() . '/inc/widget-areas.php';

/**
* Load common helper functions.
*/
require get_template_directory() . '/inc/helper-functions.php';

/**
* Load WC Plugins.
*/
require get_template_directory() . '/plugins/wc/shop-page/featured-products.php';
require get_template_directory() . '/plugins/wc/cart/quantity-updater.php';
require get_template_directory() . '/plugins/wc/checkout/payment-method-position.php';
require get_template_directory() . '/plugins/wc/mini-cart/mini-cart-functions.php';
require get_template_directory() . '/plugins/wc/single-product/related-products.php';
require get_template_directory() . '/plugins/wc/single-product/tabs.php';
require get_template_directory() . '/plugins/wc/shop-page/add-to-cart.php';
require get_template_directory() . '/plugins/wc/shop-page/customize.php';
require get_template_directory() . '/plugins/wc/shop-page/product-button-text.php';
require get_template_directory() . '/plugins/wc/my-account/myaccount-functions.php';
require get_template_directory() . '/plugins/wc/auth_login_and_registration.php';
