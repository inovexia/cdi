<?php
/**
* Functions which enhance the theme by hooking into WordPress
*
* @package Inovexia_WP_Theme
*/

/**
* Functions which enhance the theme by hooking into WordPress
*
* @package Inovexia_WP_Starter
*/


/**
* Remove existing hook for product pages breadcrumb
* @hooked woocommerce_breadcrumb - 20
**/
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

/**
* Remove product rating stars
**/
remove_action('woocommerce_single_product_summary', 'woocommerce_template_loop_rating', 20, 0);

/**
* Show product rating stars after product title
**/
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10, 0);
add_action ('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 15, 0);

/**
* Remove single product meta information
**/
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40, 0);

/* Function to get total products count */
function total_product_count($post_type='product', $post_status='publish') {
   $args = array( 'post_type' => $post_type, 'posts_per_page' => -1, 'post_status' => $post_status );

   $products = new WP_Query( $args );

   return $products->found_posts;
}


/**
* Register widget area.
*
* @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
*/
function invwp_init_sidebars () {
// LEFT SIDEBAR
register_sidebar(
	array(
		'name'          => esc_html__( 'Sidebar Left', 'invwp' ),
		'id'            => 'sidebar-left',
		'description'   => esc_html__( 'Add widgets here.', 'invwp' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	)
);
// RIGHT SIDEBAR
register_sidebar(
	array(
		'name'          => esc_html__( 'Sidebar Right', 'invwp' ),
		'id'            => 'sidebar-right',
		'description'   => esc_html__( 'Add widgets here.', 'invwp' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	)
);
// TOP FOOTER ABOUT
register_sidebar(
	array(
		'name'          => esc_html__( 'Top Footer About Us', 'invwp' ),
		'id'            => 'top-footer-about',
		'description'   => esc_html__( 'Add widgets here.', 'invwp' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	)
);
// TOP FOOTER MENU
register_sidebar(
	array(
		'name'          => esc_html__( 'Top Footer Menu', 'invwp' ),
		'id'            => 'top-footer-menu',
		'description'   => esc_html__( 'Add widgets here.', 'invwp' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	)
);
// TOP FOOTER CUSTOMER
register_sidebar(
	array(
		'name'          => esc_html__( 'Top Footer Customer Services', 'invwp' ),
		'id'            => 'top-footer-customer-service',
		'description'   => esc_html__( 'Add widgets here.', 'invwp' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	)
);
// TOP FOOTER CONTACT
register_sidebar(
	array(
		'name'          => esc_html__( 'Top Footer Contact', 'invwp' ),
		'id'            => 'top-footer-contact',
		'description'   => esc_html__( 'Add widgets here.', 'invwp' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	)
);
// TOP FOOTER NEWSLETTER
register_sidebar(
	array(
		'name'          => esc_html__( 'Top Footer Newsletter', 'invwp' ),
		'id'            => 'top-footer-newsletter',
		'description'   => esc_html__( 'Add widgets here.', 'invwp' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	)
);

// BOTTOM FOOTER LEFT
register_sidebar(
	array(
		'name'          => esc_html__( 'Bottom Footer Left', 'invwp' ),
		'id'            => 'bottom-footer-left',
		'description'   => esc_html__( 'Add widgets here.', 'invwp' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	)
);
// BOTTOM FOOTER RIGHT
register_sidebar(
	array(
		'name'          => esc_html__( 'Bottom Footer Right', 'invwp' ),
		'id'            => 'bottom-footer-right',
		'description'   => esc_html__( 'Add widgets here.', 'invwp' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	)
);
}
add_action( 'widgets_init', 'invwp_init_sidebars' );


/**
* Load theme files.
*/
require get_template_directory() . '/inc/enqueue.php';

/**
* Load WC Plugins.
*/
require get_template_directory() . '/plugins/wc/shop-page/featured-products.php';

/**
* Load WC Plugins.
*/
require get_template_directory() . '/plugins/wc/cart/quantity-updater.php';

/**
* Load WC Plugins.
*/
//require get_template_directory() . '/plugins/wc/auth_login_and_registration.php';


/**
* Load WC Plugins.
*/
require get_template_directory() . '/plugins/wc/checkout/payment-method-position.php';

/**
* Load WC Plugins.
*/
//require get_template_directory() . '/plugins/wc/group-buy/group-buy-functions.php';

/**
* Load WC Plugins.
*/
require get_template_directory() . '/plugins/wc/mini-cart/mini-cart-functions.php';

/**
* Load WC Plugins.
*/
require get_template_directory() . '/plugins/wc/single-product/related-products.php';

/**
* Load WC Plugins.
*/
require get_template_directory() . '/plugins/wc/single-product/tabs.php';

/**
* Load WC Plugins.
*/
require get_template_directory() . '/plugins/wc/shop-page/add-to-cart.php';

/**
* Load WC Plugins.
*/
//require get_template_directory() . '/plugins/wc/shop-page/customize.php';


/**
* Load WC Plugins.
*/
require get_template_directory() . '/plugins/wc/shop-page/product-button-text.php';
