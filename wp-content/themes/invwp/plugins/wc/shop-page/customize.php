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

//default sorting rename function
add_filter( 'woocommerce_catalog_orderby', 'mspa_rename_default_sorting_options' );
function mspa_rename_default_sorting_options( $options ){

  $options[ 'menu_order' ] = 'Sort by price'; // rename
  return $options;

}

/**
 * Add view product button in shop page
**/
add_action ('invwx_product_buttons', 'invwx_view_product_button', 15);
function invwx_view_product_button () {
    global $product;
    $link = $product->get_permalink();
    echo do_shortcode('<a href="'.$link.'" class="view-pdt button-primary">VIEW PRODUCT</a>');
}

/**
 * Remove product add to cart button in shop page
**/
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10, 0);
add_action ('invwx_product_buttons', 'woocommerce_template_loop_add_to_cart', 10, 0);
