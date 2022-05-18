<?php

/* Function to get total products count */
function invwp_total_product_count ($post_type='product', $post_status='publish') {
   $args = array( 'post_type' => $post_type, 'posts_per_page' => -1, 'post_status' => $post_status );

   $products = new WP_Query( $args );

   return $products->found_posts;
}


// Function to return an array of product categories and sub categories
function invwp_get_product_categories () {
  $cats =  array();
  $args = array(
          'taxonomy' => 'product_cat',
          'hide_empty' => false,
          'parent'   => 0
  );
  $product_cat = get_terms( $args );

  foreach ($product_cat as $parent_product_cat)  {
    $id = $parent_product_cat->term_id;
    $cats[$id] = [
        'id'=>$parent_product_cat->term_id,
        'name'=>$parent_product_cat->name,
        'link'=>get_term_link($parent_product_cat->term_id),
    ];
    $child_args = array(
              'taxonomy' => 'product_cat',
              'hide_empty' => false,
              'parent'   => $parent_product_cat->term_id
          );
    $child_product_cats = get_terms( $child_args );
    foreach ($child_product_cats as $child_product_cat) {
      $cats[$id]['sub_cats'][] = [
        'id'=>$child_product_cat->term_id,
        'name'=>$child_product_cat->name,
        'link'=>get_term_link($child_product_cat->term_id)
      ];
    }
  }
  return $cats;
}


// Function to get most popular products
function invwp_get_popular_products ($args=[]) {
  // Get recommended products (Bestselling products in random order)
  if (empty ($args)) {
    $args = array(
      'posts_per_page' => -1,
      'post_type' => 'product',
      'post_status' => 'publish',
      'ignore_sticky_posts' => 1,
      'meta_key' => 'total_sales',
      'orderby' => 'rand',
      'order' => '',
    );
  }
  $recommended = new WP_Query($args);
  return $recommended;
}

// Function to get bestseller products
function invwp_get_bestseller_products ($args=[]) {
  // Get bestseller products (Bestselling products in descending order by total sale)
  if (empty ($args)) {
    $args = array(
      'posts_per_page' => -1,
      'post_type' => 'product',
      'post_status' => 'publish',
      'ignore_sticky_posts' => 1,
      'meta_key' => 'total_sales',
      'orderby' => 'meta_value_num',
      'order' => 'DESC',
    );
  }
  $bestseller = new WP_Query($args);
  return $bestseller;
}

// Function to get favourite products
function invwp_get_toprated_products ($args=[]) {
  // Get top rated products (Products on sale)
  if (empty ($args)) {
    $args = array(
      'posts_per_page' => -1,
      'post_type' => 'product',
      'post_status' => 'publish',
      'ignore_sticky_posts' => 1,
      'meta_key'       => '_wc_average_rating',
      'orderby'        => 'meta_value_num',
      'order'          => 'DESC',
      'meta_query'     => WC()->query->get_meta_query(),
      'tax_query'      => WC()->query->get_tax_query(),
    );
  }
  $favourite = new WP_Query($args);
  return $favourite;
}

// Function to get bestseller products
function invwp_get_onsale_products ($args=[]) {
  // Get onsale products (Products on sale)
  if (empty ($args)) {
    $args = array(
      'posts_per_page' => -1,
      'post_type' => 'product',
      'post_status' => 'publish',
      'ignore_sticky_posts' => 1,
      'meta_key' => '_sale_price',
      'meta_value' => 0,
      'meta_compare' => '>=',
      'meta_type' => 'NUMERIC',
      'orderby' => 'meta_value_num',
      'order' => 'DESC',
    );
  }
  $onsale = new WP_Query($args);
  return $onsale;
}

// Function to get products from all brands
function invwp_get_allbrand_products ($args=[]) {
  // Get onsale products (Products on sale)
  if (empty ($args)) {
    $args = array(
      'posts_per_page' => -1,
      'post_type' => 'product',
      'post_status' => 'publish',
      'ignore_sticky_posts' => 1,
      'tax_query' => array(
          array (
            'taxonomy' => 'brand',
          ),
         ),
      'order' => 'DESC',
    );
  }
  $onsale = new WP_Query($args);
  return $onsale;
}
