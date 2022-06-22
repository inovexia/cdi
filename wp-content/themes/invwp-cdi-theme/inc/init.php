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
* Load default woocommerce layout customizer.
*/
require get_template_directory() . '/inc/plugins/custom-post-type.php';
require get_template_directory() . '/inc/plugins/custom-layout.php';
require get_template_directory() . '/inc/plugins/show-featured-products.php';
require get_template_directory() . '/inc/plugins/add-to-cart.php';
require get_template_directory() . '/inc/plugins/quantity-updater.php';
require get_template_directory() . '/inc/plugins/product-tabs.php';
require get_template_directory() . '/inc/plugins/multi-step-checkout.php';
//require get_template_directory() . '/inc/plugins/product-group-buy.php';
require get_template_directory() . '/inc/plugins/auth-login-registration.php';
//require get_template_directory() . '/inc/plugins/checkout-shipping-fields.php';
