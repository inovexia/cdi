<?php
/**
 * Enqueue scripts and styles.
 */
function invx_add_theme_scripts () {

    /* Add scripts */

    wp_enqueue_script('jquerymainmin', "https://code.jquery.com/jquery-3.3.1.min.js" );
    /*wp_enqueue_script( 'main-js', get_template_directory_uri() . '/assets/js/main.js', array(), _S_VERSION, true );*/

    wp_enqueue_script( 'invwps-swiper-bundle-js', 'https://unpkg.com/swiper@8/swiper-bundle.min.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'invwps-swiper-sliders-js', get_template_directory_uri() . '/assets/js/swiper-sliders.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'invwps-multi-step-checkout', get_template_directory_uri() . '/assets/js/multi-step-checkout.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'invwps-multi-step-user-registration', get_template_directory_uri() . '/assets/js/multi-step-user-registration.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'invwps-mainjs', get_template_directory_uri() . '/assets/js/main.js', array(), _S_VERSION, true );

    /*
    // For country/states dropdown lists
    $wc_country = array(
        'countries' => json_encode( array_merge( WC()->countries->get_allowed_country_states(), WC()->countries->get_shipping_country_states() ) )
    );
    wp_enqueue_script('country-js', get_stylesheet_directory_uri() . '/assets/js/country.js' );
    wp_localize_script( 'country-js', 'country_js', $wc_country );
    */

    // mini cart & cart
     wp_enqueue_script( 'invwps-cart-actions', get_template_directory_uri() . '/assets/js/cart-actions.js', array(), _S_VERSION, true );
     wp_localize_script( 'invwps-cart-actions', 'spa', array('ajax_url' => admin_url('admin-ajax.php')));

    /* Add styles */
    // Reset and Normalize
    wp_enqueue_style( 'invwps-reset-css', get_template_directory_uri () . '/assets/css/reset.css', array(), _S_VERSION, 'all' );
    wp_enqueue_style( 'invwps-normalize-css', get_template_directory_uri() . '/assets/css/normalize.css', array(), _S_VERSION, 'all');

    // Google Fonts
    wp_enqueue_style( 'invwps-google-fonts', 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap', false );

    wp_enqueue_style( 'invwps-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css' );


    // Style guide and global css
    wp_enqueue_style( 'invwps-styleguide-css', get_template_directory_uri () . '/assets/css/styleguide.css', array(), _S_VERSION, 'all' );
    wp_enqueue_style( 'invwps-global-css', get_template_directory_uri () . '/assets/css/global.css', array(), _S_VERSION, 'all' );
    //wp_enqueue_style( 'invwps-common-css', get_template_directory_uri () . '/assets/css/common-component.css', array(), _S_VERSION, 'all' );
    // SwiperJs styles
    wp_enqueue_style( 'invwps-swiper-bundle-css', 'https://unpkg.com/swiper@8/swiper-bundle.min.css', array(), _S_VERSION, 'all' );
    wp_enqueue_style( 'invwps-swiper-styles-css', get_template_directory_uri () . '/assets/css/swiper-styles.css', array(), _S_VERSION, 'all' );
    /*
    wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/css/fontawesome.min.css', array(), _S_VERSION, 'all');*/
    wp_enqueue_style( 'invwps-mscu-css', get_template_directory_uri () . '/assets/css/multi-step-checkout.css', array(), _S_VERSION, 'all' );
    wp_enqueue_style( 'invwps-msur-css', get_template_directory_uri () . '/assets/css/multi-step-user-registration.css', array(), _S_VERSION, 'all' );
    //wp_enqueue_style( 'invwps-home-css', get_template_directory_uri () . '/assets/css/home.css', array(), _S_VERSION, 'all' );
    //wp_enqueue_style( 'invwps-shop-css', get_template_directory_uri () . '/assets/css/shop.css', array(), _S_VERSION, 'all' );
    //wp_enqueue_style( 'invwps-login-modalcss', get_template_directory_uri () . '/assets/css/login-modal.css', array(), _S_VERSION, 'all' );


}
add_action( 'wp_enqueue_scripts', 'invx_add_theme_scripts' );

// Load all styles in header
add_action( 'wp_head', 'wp_enqueue_style' );

// Load all scripts in footer
add_action( 'wp_footer', 'wp_enqueue_script' );
