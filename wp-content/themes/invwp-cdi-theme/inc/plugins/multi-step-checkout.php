<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Inovexia_WP_Starter
 */


remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );
add_action( 'invwp_woocommerce_checkout_login_form', 'woocommerce_checkout_login_form', 10 );

remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
add_action( 'invwp_woocommerce_payment_methods', 'woocommerce_checkout_payment', 5 );

// Remove the Have a coupon options form from default location
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
add_action( 'woocommerce_checkout_before_order_review', 'woocommerce_checkout_coupon_form', 5 );

add_action( 'invwp_woocommerce_checkout_place_order_button', 'invwp_checkout_place_order_button', 5 );
function invwp_checkout_place_order_button () {
  echo apply_filters( 'woocommerce_order_button_html', '<button type="submit" class="button alt" name="woocommerce_checkout_place_order button-primary" id="place_order" value="">Checkout</button>' ); // @codingStandardsIgnoreLine
}


add_action( 'wp_head', 'invwp_multi_step_checkout_style' );
function invwp_multi_step_checkout_style () {
  // Only run this on the checkout page
  //if ( ! is_page ('checkout')) return;
  wp_enqueue_style( 'invwps-msc-css', get_template_directory_uri () . '/assets/css/multi-step-checkout.css', array(), _S_VERSION, 'all' );
}



add_action( 'wp_footer', 'invwp_multi_step_checkout_script' );
function invwp_multi_step_checkout_script () {
  // Only run this on the single product page
  //if ( ! is_page ('checkout')) return;
  ?>
<script type="text/javascript" src="<?php echo get_template_directory_uri () .'/assets/js/multi-step-checkout.js'; ?>">
</script>
<?php
}