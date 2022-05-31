<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Inovexia_WP_Starter
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */

/*
* Creating a function to create our CPT
*/

function custom_post_type_testimonial () {

    /*Custom Post type start*/
    $supports = array(
      'title', // post title
      'editor', // post content
      'author', // post author
      'thumbnail', // featured images
      'excerpt', // post excerpt
      'custom-fields', // custom fields
      'comments', // post comments
      'revisions', // post revisions
      'post-formats', // post formats
    );
    $labels = array(
      'name' => _x('Our testimonial', 'plural'),
      'singular_name' => _x('Our testimonial', 'singular'),
      'menu_name' => _x('testimonial', 'admin menu'),
      'name_admin_bar' => _x('testimonial', 'admin bar'),
      'add_new' => _x('Add New', 'add new'),
      'add_new_item' => __('Add New testimonial'),
      'new_item' => __('New testimonial'),
      'edit_item' => __('Edit testimonial'),
      'view_item' => __('View testimonial'),
      'all_items' => __('All testimonial'),
      'search_items' => __('Search testimonial'),
      'not_found' => __('No testimonial found.'),
    );
    $args = array(
      'supports' => $supports,
      'labels' => $labels,
      'public' => true,
      'rewrite' => array('slug' => 'our-testimonial'),
      'has_archive' => true,
    );
    register_post_type('testimonial', $args);
    // register taxonomy
    register_taxonomy('testimonial', 'testimonial', array('hierarchical' => true, 'label' => 'Category', 'query_var' => true, 'rewrite' => array( 'slug' => 'testimonial' )));

}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not
* unnecessarily executed.
*/
add_action( 'init', 'custom_post_type_testimonial', 0 );