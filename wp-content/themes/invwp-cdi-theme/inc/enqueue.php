<?php
/**
 * Enqueue scripts and styles.
 */
function invx_add_theme_scripts () {

		/* Add scripts */

		wp_enqueue_script('jquerymainmin', "https://code.jquery.com/jquery-3.3.1.min.js" );
		wp_enqueue_script( 'invwps-swiper-bundle-js', 'https://unpkg.com/swiper@8/swiper-bundle.min.js', array(), _S_VERSION, true );
		wp_enqueue_script( 'invwps-swiper-sliders-js', get_template_directory_uri() . '/assets/js/swiper-sliders.js', array(), _S_VERSION, true );
		wp_enqueue_script( 'invwps-main-js', get_template_directory_uri() . '/assets/js/main.js', array(), _S_VERSION, true );
		wp_enqueue_script( 'invwps-accordian-js', get_template_directory_uri() . '/assets/js/accordian.js', array(), _S_VERSION, true );

		// For country/states dropdown lists
		$wc_country = array(
		    'countries' => json_encode( array_merge( WC()->countries->get_allowed_country_states(), WC()->countries->get_shipping_country_states() ) )
		);
		wp_enqueue_script('country-js', get_stylesheet_directory_uri() . '/assets/js/country.js' );
		wp_localize_script( 'country-js', 'country_js', $wc_country );
		/*
		*/

		// mini cart & cart
		//wp_enqueue_script( 'invwps-cart-actions', get_template_directory_uri() . '/assets/js/cart-actions.js', array(), _S_VERSION, true );
		// wp_localize_script( 'invwps-cart-actions', 'spa', array('ajax_url' => admin_url('admin-ajax.php')));

		/* Add styles */

		// Google Fonts
		wp_enqueue_style( 'invwps-google-fonts-lato', 'https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap', false );
		wp_enqueue_style( 'invwps-google-fonts-syncopate', 'https://fonts.googleapis.com/css2?family=Syncopate:wght@400;700&display=swap', false );
		// Fontawesome icons
		wp_enqueue_style( 'invwps-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css' );
		// Style guide and global css
		wp_enqueue_style( 'invwps-styleguide-css', get_template_directory_uri () . '/assets/css/styleguide.css', array(), _S_VERSION, 'all' );
		wp_enqueue_style( 'invwps-header-css', get_template_directory_uri () . '/assets/css/header.css', array(), _S_VERSION, 'all' );
		wp_enqueue_style( 'invwps-global-css', get_template_directory_uri () . '/assets/css/global.css', array(), _S_VERSION, 'all' );
		wp_enqueue_style( 'invwps-common-component-css', get_template_directory_uri () . '/assets/css/common-component.css', array(), _S_VERSION, 'all' );
		wp_enqueue_style( 'invwps-mega-menu-css', get_template_directory_uri () . '/assets/css/mega-menu.css', array(), _S_VERSION, 'all' );
		wp_enqueue_style( 'invwps-login-register-css', get_template_directory_uri () . '/assets/css/login-register.css', array(), _S_VERSION, 'all' );

		wp_enqueue_style( 'invwps-swiper-bundle-css', 'https://unpkg.com/swiper@8/swiper-bundle.min.css', array(), _S_VERSION, 'all' );

		wp_enqueue_style( 'invwps-shop-css', get_template_directory_uri () . '/assets/css/shop.css', array(), _S_VERSION, 'all' );
		wp_enqueue_style( 'invwps-product-css', get_template_directory_uri () . '/assets/css/product.css', array(), _S_VERSION, 'all' );
		wp_enqueue_style( 'invwps-cart-css', get_template_directory_uri () . '/assets/css/cart.css', array(), _S_VERSION, 'all' );
		wp_enqueue_style( 'invwps-minicart-css', get_template_directory_uri () . '/assets/css/minicart.css', array(), _S_VERSION, 'all' );
		wp_enqueue_style( 'invwps-checkout-css', get_template_directory_uri () . '/assets/css/checkout.css', array(), _S_VERSION, 'all' );
		wp_enqueue_style( 'invwps-my-account-css', get_template_directory_uri () . '/assets/css/my-account.css', array(), _S_VERSION, 'all' );
		wp_enqueue_style( 'invwps-accordian-css', get_template_directory_uri () . '/assets/css/accordian.css', array(), _S_VERSION, 'all' );

		if (is_page ('home')) {
			wp_enqueue_style( 'invwps-home-css', get_template_directory_uri () . '/assets/css/home.css', array(), _S_VERSION, 'all' );
		}
		wp_enqueue_style( 'invwps-about-css', get_template_directory_uri () . '/assets/css/about.css', array(), _S_VERSION, 'all' );
		wp_enqueue_style( 'invwps-contact-css', get_template_directory_uri () . '/assets/css/contact.css', array(), _S_VERSION, 'all' );
		wp_enqueue_style( 'invwps-privacy-css', get_template_directory_uri () . '/assets/css/privacy.css', array(), _S_VERSION, 'all' );
		wp_enqueue_style( 'invwps-magenta-css', get_template_directory_uri () . '/assets/css/magenta.css', array(), _S_VERSION, 'all' );
		wp_enqueue_style( 'invwps-blog-and-single-blog-css', get_template_directory_uri () . '/assets/css/blog-and-single-blog.css', array(), _S_VERSION, 'all' );
		wp_enqueue_style( 'invwps-referral-css', get_template_directory_uri () . '/assets/css/referral.css', array(), _S_VERSION, 'all' );
		
		wp_enqueue_style( 'invwps-search-page-css', get_template_directory_uri () . '/assets/css/search-page.css', array(), _S_VERSION, 'all' );
		wp_enqueue_style( 'invwps-blogs-category-css', get_template_directory_uri () . '/assets/css/blogs-category.css', array(), _S_VERSION, 'all' );
}

add_action( 'wp_enqueue_scripts', 'invx_add_theme_scripts' );

// Load all styles in header
add_action( 'wp_head', 'wp_enqueue_style' );

// Load all scripts in footer
add_action( 'wp_footer', 'wp_enqueue_script' );