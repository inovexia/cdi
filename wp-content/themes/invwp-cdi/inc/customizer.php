<?php
/**
 * Inovexia WP Theme Theme Customizer
 *
 * @package Inovexia_WP_Theme
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function invwp_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'invwp_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'invwp_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'invwp_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function invwp_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function invwp_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function invwp_customize_preview_js() {
	wp_enqueue_script( 'invwp-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'invwp_customize_preview_js' );

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