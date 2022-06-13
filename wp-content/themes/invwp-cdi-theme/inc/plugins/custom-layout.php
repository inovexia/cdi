<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Inovexia_WP_Starter
 */


/**
 * Single product page
 * Remove existing hook for product pages breadcrumb
 * @hooked woocommerce_breadcrumb - 20
**/
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
add_action('invwp_woocommerce_breadcrumb', 'woocommerce_breadcrumb', 10, 0);


/**
 * Change hook position
 * @hooked woocommerce_result_count
 * @hooked woocommerce_catalog_ordering
**/
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20, 0);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30, 0);
add_action('invwp_woocommerce_before_shop_loop', 'woocommerce_result_count', 10, 0);
add_action('invwp_woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 20, 0);

/**
 * Change hook position
 * @hooked woocommerce_show_product_sale_flash
 * @hooked woocommerce_show_product_images
 **/
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10, 0);
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20, 0);
add_action('invwp_woocommerce_show_product_images', 'woocommerce_show_product_sale_flash', 10, 0);
add_action('invwp_woocommerce_show_product_images', 'woocommerce_show_product_images', 20, 0);

/**
 * Change hook position
 * @hooked woocommerce_show_product_sale_flash
 * @hooked woocommerce_show_product_images
 **/
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10, 0);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20, 0);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30, 0);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40, 0);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50, 0);
add_action('invwp_woocommerce_show_product_data', 'woocommerce_template_single_excerpt', 5, 0);
add_action('invwp_woocommerce_show_product_data', 'woocommerce_template_single_add_to_cart', 5, 0);
add_action('invwp_woocommerce_show_product_data', 'woocommerce_template_single_meta', 5, 0);
add_action('invwp_woocommerce_show_product_data', 'woocommerce_template_single_sharing', 5, 0);

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5, 0);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10, 0);
add_action ('invwp_woocommerce_single_product_summary', 'woocommerce_template_single_title', 5, 0);
add_action ('invwp_woocommerce_single_product_summary', 'woocommerce_template_single_price', 10, 0);

add_action('invwp_woocommerce_show_product_rating', 'woocommerce_template_single_rating', 10, 0);

// Checkout page
remove_action( 'woocommerce_proceed_to_checkout', 'wc_get_pay_buttons', 10 );
remove_action( 'woocommerce_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 20 );
add_action( 'invwp_proceed_to_checkout', 'wc_get_pay_buttons', 10 );
add_action( 'invwp_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 20 );
