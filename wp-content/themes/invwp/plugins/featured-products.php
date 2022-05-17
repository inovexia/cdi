<?php

//shop recommended products
//add_action ('mspa_shop_page_featured_products', 'mspa_show_featured_products');
function invwp_show_featured_products () {

  global $woocommerce, $product;

  $products = 10;
  $orderby = 'name';
  $order = 'asc';

  // The tax query
  $tax_query[] = array(
    'taxonomy' => 'product_visibility',
    'field'    => 'name',
    'terms'    => 'featured',
    'operator' => 'IN', // or 'NOT IN' to exclude feature products
  );

  // The arguments
  $args = array(
    'post_type'           => 'product',
    'post_status'         => 'publish',
    'ignore_sticky_posts' => 1,
    'posts_per_page'      => $products,
    'orderby'             => $orderby,
    'order'               => $order == 'asc' ? 'asc' : 'desc',
    'tax_query'           => $tax_query // <===
  ) ;

  // The query
  $query = new WP_Query($args);
  ?>
  <!-- Slider main container -->
  <div class="shop-page-featured-product-slider swiper">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
      <?php
      // woocommerce_product_loop_start();
      if ( $query->have_posts () ) {
        while ( $query->have_posts() ) {
          $query->the_post();
          /**
           * Hook: woocommerce_shop_loop.
           */
          echo '<div class="swiper-slide">';
            do_action( 'woocommerce_shop_loop' );

            wc_get_template_part( 'content', 'product' );
          echo '</div>';
        }
      }

      // woocommerce_product_loop_end();
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
