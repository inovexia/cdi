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
?>

<?php
/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

?>
  <section class="full-width">

    <div class="container">

      <div class="row">

          <div class="col-3">
            <?php get_sidebar('shop'); ?>
          </div>

          <div class="col-9">

            <div class="content">

                <?php
                /**
                * Hook: woocommerce_archive_description.
                *
                * @hooked woocommerce_taxonomy_archive_description - 10
                * @hooked woocommerce_product_archive_description - 10
                */
                do_action( 'woocommerce_archive_description' );
                ?>

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
                  <?php
                  /**
                   * Hook: woocommerce_after_shop_loop.
                   *
                   * @hooked woocommerce_pagination - 10
                   */
                  do_action( 'woocommerce_after_shop_loop' );
                } else {
                  /**
                   * Hook: woocommerce_no_products_found.
                   *
                   * @hooked wc_no_products_found - 10
                   */
                  do_action( 'woocommerce_no_products_found' );
                }
                ?>
                <div class="clearfix"></div>
                <p>
                  <?php
                  /**
                   * Hook: woocommerce_after_shop_loop.
                   *
                   * @hooked woocommerce_pagination - 10
                   */
                  //do_action('woocommerce_after_shop_loop');
                  ?>
                </p>

            </div><!-- Content -->
          </div>
      </div>
    </div><!-- Container -->
  </section>

  <!--<section class="featured-product full-width">
  	<div class="container">
  		<div class="row">
  			<div class="col-12">
  				<h4 class="text-center">FEATURED PRODUCTS</h4>

  				<?php
  				/**
  				 * mspa_show_featured_products.
  				 *
  				 * @hooked Displays featured product section
  				 */
  				//invwp_show_featured_products ();
  				?>
  			</div>
  		</div>
  	</div>
  </section>-->

<?php
	/**
	 * Hook: woocommerce_after_main_content.
	 *
	 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
	 */
	do_action( 'woocommerce_after_main_content' );
?>

<?php
get_footer( 'shop' );
