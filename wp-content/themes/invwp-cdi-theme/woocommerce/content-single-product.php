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
<div class="single-product-content">
    <div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
        <div class="container">
            <div class="row">
                <div class="product-sidebar col-3">
                    <?php get_sidebar('shop'); ?>
                </div>
                <div class="product-outer col-9">
                    <div class="row">
                        <div class="col-6 product-data-right">

                            <div class="product-title mob-d-block">
                                <?php
										/*
										 * Custom action:
										 * @hooked plugins/custom-layout.php
										 * Show product title and price
										*/
										do_action( 'invwp_woocommerce_single_product_summary' );
										?>
                            </div>
                            <div class="category-info mob-d-block">
                                <?php echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in_category">' . _n( '', '', count( $product->get_category_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>
                            </div>
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
                    </div>
                    <div class="product-description">

                        <div class="row">
                            <div class="col-12">
                                <?php do_action ('invwp_woocommerce_show_product_description'); ?>
                            </div>
                        </div>

                    </div>
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
</div>

<!-- Related product section -->
<section id="single-product-related-products" class="product-section related-product-single-page">
    <div class="container">
        <div class="row related-header">
            <div class="fraction-header">
                <h3>Related Products</h3>
                <div class="swiper-pagination"></div>
            </div>


            <a href="<?php echo site_url(); ?>/shop">All Products</a>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">

                        <?php
							global $post;
							$related = get_posts( 
							  array( 
							  'category__in' => wp_get_post_categories( $post->ID ), 
							  'numberposts'  => 4, 
							  'post__not_in' => array( $post->ID ),
							  'post_type'    => 'product'
							  ) 
							);
							  if( $related ) { 
								foreach( $related as $post ) {
									setup_postdata($post); 
									$thumbnail = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()), 'full' );
									$product = wc_get_product( get_the_ID() );
									  $permalink = get_the_permalink(get_the_ID());
									  $title = get_the_title();
									  $price = $product->get_price_html(); ?>


                        <div class="swiper-slide">
                            <div class="related-product-box">
                                <div class="related-product-image">
                                    <img src="<?php echo $thumbnail; ?>" alt="" />
                                </div>
                                <div class="related-product-footer">
                                    <a href="<?php echo $permalink; ?>"><?php echo $title; ?></a>
                                    <span><?php echo $price; ?></span>
                                </div>
                            </div>
                        </div>




                        <?php  }
							 wp_reset_postdata();
							}
								?>
                    </div>

                    <div class="nav-arrow">
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php do_action( 'woocommerce_after_single_product' ); ?>