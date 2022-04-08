<?php
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
