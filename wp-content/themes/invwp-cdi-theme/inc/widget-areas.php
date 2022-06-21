<?php

/**
* Register widget area.
*
* @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
*/
add_action( 'widgets_init', 'invwp_init_widget_areas' );
function invwp_init_widget_areas () {

  // Define widget areas here
  $widget_area = [
    ['name'=>'Sidebar Left', 'id'=>'sidebar-left'],
    ['name'=>'Sidebar Right', 'id'=>'sidebar-right'],
    ['name'=>'Top Header Menu Left', 'id'=>'top-header-menu1'],
    ['name'=>'Top Header Menu', 'id'=>'top-header-menu'],
    ['name'=>'Top Header Menu Right', 'id'=>'top-header-menu2'],
	  ['name'=>'Top Footer Logo', 'id'=>'top-footer-logo'],
    ['name'=>'Top Footer About Us', 'id'=>'top-footer-about'],
    ['name'=>'Top Footer Menu', 'id'=>'top-footer-menu'],
    ['name'=>'Top Footer Customer Services', 'id'=>'top-footer-customer-service'],
    ['name'=>'Top Footer Contact', 'id'=>'top-footer-contact'],
    ['name'=>'Top Footer Newsletter', 'id'=>'top-footer-newsletter'],
    ['name'=>'Bottom Footer Left', 'id'=>'bottom-footer-left'],
    ['name'=>'Bottom Footer Right', 'id'=>'bottom-footer-right'],
    ['name'=>'sitemap col 1', 'id'=>'sitemap-col-1'],
    ['name'=>'sitemap col 2', 'id'=>'sitemap-col-2'],
    ['name'=>'sitemap col 3', 'id'=>'sitemap-col-3'],
    ['name'=>'sitemap col 4', 'id'=>'sitemap-col-4'],
  ];

  // Function to register widget area
  foreach ($widget_area as $widget) {
    register_dynamic_sidebar ($widget['name'], $widget['id']);
  }
}

// Function to register widget area
function register_dynamic_sidebar ($name='Widget', $id='widget-id') {
  register_sidebar(
  	array(
  		'name'          => esc_html__( $name, 'invwp' ),
  		'id'            => $id,
  		'description'   => esc_html__( 'Add widgets here.', 'invwp' ),
  		'before_widget' => '<section id="%1$s" class="widget %2$s">',
  		'after_widget'  => '</section>',
  		'before_title'  => '<h6 class="widget-title">',
  		'after_title'   => '</h6>',
  	)
  );
}
