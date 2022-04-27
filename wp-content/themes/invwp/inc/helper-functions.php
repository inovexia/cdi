<?php

/* Function to get total products count */
function total_product_count($post_type='product', $post_status='publish') {
   $args = array( 'post_type' => $post_type, 'posts_per_page' => -1, 'post_status' => $post_status );

   $products = new WP_Query( $args );

   return $products->found_posts;
}


// Function to return an array of product categories and sub categories
function get_product_categories ($category_name='') {
  $cats =  array();
  $args = array(
          'taxonomy' => 'product_cat',
          'hide_empty' => true,
          'parent'   => 0,
          'slug' => $category_name, /*category name*/
        );
  $product_cat = get_terms( $args );

  foreach ($product_cat as $parent_product_cat)  {
    $id = $parent_product_cat->term_id;
    $cats[$id] = [
        'id'=>$parent_product_cat->term_id,
        'name'=>$parent_product_cat->name,
        'count'=>$parent_product_cat->count,
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
        'count'=>$child_product_cat->count,
        'link'=>get_term_link($child_product_cat->term_id)
      ];
    }
  }

  return $cats;
}
