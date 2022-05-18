<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
    <div class="container">
        <div class="row">
            <div class="col-6 product-data-left">
                <div class="product-title">
                    <?php
										/*
										 * Custom action:
										 * @hooked plugins/custom-layout.php
										 * Show product title and price
										*/
										do_action( 'invwp_woocommerce_single_product_summary' );
										?>
                </div>
                <div class="single-product-rating">
                    <?php
										/*
										 * Custom action:
										 * @hooked plugins/custom-layout.php
										 * show product rating
										*/
										do_action( 'invwp_woocommerce_show_product_rating' );
										?>
                </div>

                <?php
									/*
									 * Custom action:
									 * @hooked plugins/custom-layout.php
									 * show product rating, excerpt, add_to_cart_button
									*/
									do_action( 'invwp_woocommerce_show_product_data' );
								?>
            </div>
            <div class="col-6 product-data-right">
                <?php
								/**
								 * Hook: invwp_woocommerce_show_product_images.
								 *
								 * @hooked woocommerce_show_product_sale_flash - 10
								 * @hooked woocommerce_show_product_images - 20
								 */
								do_action( 'invwp_woocommerce_show_product_images' );
								?>
            </div>
        </div>

        <?php
				/**
				 * Hook: woocommerce_before_single_product_summary.
				 *
				 */
				do_action( 'woocommerce_before_single_product_summary' );
				?>

        <div class="summary entry-summary">
            <?php
						/**
						 * Hook: woocommerce_single_product_summary.
						 *
						 */
						do_action( 'woocommerce_single_product_summary' );
						?>
        </div>

        <div class="product-thumbnail-part">
            <?php
						/**
						 * Hook: woocommerce_before_single_product_summary.
						 *
						 */
						do_action( 'woocommerce_before_single_product_summary' );
						?>
        </div>
    </div>
</div>

<section class="product-description">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php do_action ('invwp_woocommerce_show_product_description'); ?>
            </div>
        </div>
    </div>
</section>

<!-- Related product section -->
<section id="single-product-related-products" class="product-section related-product-single-page">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php
								/**
								 * Hook: woocommerce_after_single_product_summary.
								 *
								 * @hooked woocommerce_output_product_data_tabs - 10
								 * @hooked woocommerce_upsell_display - 15
								 * @hooked woocommerce_output_related_products - 20
								 */
								do_action( 'woocommerce_after_single_product_summary' );
								?>
            </div>
        </div>
    </div>
</section>

<?php do_action( 'woocommerce_after_single_product' ); ?>
