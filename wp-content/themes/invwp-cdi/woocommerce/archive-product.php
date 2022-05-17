<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

?>

<section class="product-page-wrp shop-page-filters">
    <div class="container">
        <div class="nav-filters">
            <?php
        $shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
        if (isset($_GET['q'])) {
          $variable = $_GET['q'];
        } else {
          $variable = '';
        }
      ?>
            <input class="tab-link-hidden" type="hidden" key="<?php echo $variable; ?>" />
            <div class="category-link">
                <ul class="shop-page-tabs">
                    <?php
			$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
			?>
                    <li class="tab-link active" data="all"><a href="<?php echo $shop_page_url.'?q=all'; ?>"
                            class="tablinks">All</a></li>
                    <li class="tab-link" data="brands"><a href="<?php echo $shop_page_url.'?q=brands'; ?>"
                            class="tablinks">Brands</a></li>
                    <li class="tab-link" data="bestseller"><a href="<?php echo $shop_page_url.'?q=bestseller'; ?>"
                            class="tablinks">Best Seller</a></li>
                    <li class="tab-link" data="popular"><a href="<?php echo $shop_page_url.'?q=popular'; ?>"
                            class="tablinks">Most Popular</a></li>
                    <li class="tab-link" data="bestrated"><a href="<?php echo $shop_page_url.'?q=bestrated'; ?>"
                            class="tablinks">Best Rated</a></li>
                </ul>
            </div>
            <div class="sorting">

                <?php do_action( 'invwp_woocommerce_before_shop_loop' ); ?>

            </div>
        </div>
</section>

<section class="full-width product-list">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="content">
                    <?php
				if ( woocommerce_product_loop() ) {

					/**
					 * Hook: woocommerce_before_shop_loop.
					 *
					 * @hooked woocommerce_output_all_notices - 10
					 * @hooked woocommerce_result_count - 20
					 * @hooked woocommerce_catalog_ordering - 30
					 */
					do_action( 'woocommerce_before_shop_loop' );
					

					woocommerce_product_loop_start();

					if ( wc_get_loop_prop( 'total' ) ) {
						while ( have_posts() ) {
							the_post();

							/**
							 * Hook: woocommerce_shop_loop.
							 */
							do_action( 'woocommerce_shop_loop' );

							wc_get_template_part( 'content', 'product' );
						}
					}

					woocommerce_product_loop_end();
					?>
                    <div class="clearfix"></div>
                    <p>
                        <?php
						/**
						 * Hook: woocommerce_after_shop_loop.
						 *
						 * @hooked woocommerce_pagination - 10
						 */
						do_action('woocommerce_after_shop_loop');
						?>
                    </p>

                    <?php

				} else {
					/**
					 * Hook: woocommerce_no_products_found.
					 *
					 * @hooked wc_no_products_found - 10
					 */
					do_action( 'woocommerce_no_products_found' );
				}
				?>
                </div><!-- Content -->
            </div>
        </div>
    </div>
</section>
<?php
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: invwp_woocommerce_featured_products.
 *
 * @hooked outputs featured products
 */
do_action( 'invwp_woocommerce_featured_products' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
//do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );