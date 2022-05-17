<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Inovexia_WP_Starter
 */


 /**
 * Reposition related products on single product page
 **/
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20, 0);
add_action('woocommerce_after_single_product', 'invwps_show_related_products', 20, 0);
function invwps_show_related_products () {

  global $post;
  ?>
  <h2 class="text-center">Related Products</h2>
  <!-- Slider main container -->
  <div class="single-product-related-slider swiper">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
      <?php
      $args = array (
        'category__in' => wp_get_post_categories( $post->ID ),
        'numberposts'  => 10,
        'post__not_in' => array( $post->ID ),
        'post_type'    => 'product'
      );

      $query = new WP_Query($args);

      //  woocommerce_product_loop_start();

      if ( $query->have_posts () ) {
        while ( $query->have_posts() ) {
          ?>
          <!-- Slides -->
          <div class="swiper-slide">
            <?php
              $query->the_post();
              /**
               * Hook: woocommerce_shop_loop.
               */
              do_action( 'woocommerce_shop_loop' );

              wc_get_template_part( 'content', 'product' );
            ?>
         </div>
         <?php
        }
      }
      //woocommerce_product_loop_end();
      wp_reset_postdata();
      ?>
    </div>
    <!-- If we need pagination -->
    <div class="swiper-pagination"></div>

    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>

    <!-- If we need scrollbar -->
    <div class="swiper-scrollbar"></div>
  </div>
<?php
}
