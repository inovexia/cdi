<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Inovexia_WP_Starter
 */

/* Re-position payment method  */

// Remove the payment options form from default location
//remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );

// Add the payment options form under the "Payment" section (tab)
// Important you will have to also add the following custom CSS:
// body .woocommerce-checkout-payment { float: none; width: 100%; }
//add_action( 'woocommerce_checkout_after_customer_details', 'woocommerce_checkout_payment', 20 );

// Remove the Have a coupon options form from default location
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );

// Display Coupon under Proceed to Checkout Button @ WooCommerce Cart
add_action( 'woocommerce_review_order_after_cart_contents', 'woocommerce_checkout_coupon_form_custom' );
function woocommerce_checkout_coupon_form_custom() {
    echo '<tr class="coupon-form"><td colspan="2">';

    wc_get_template(
        'checkout/form-coupon.php',
        array(
            'checkout' => WC()->checkout(),
        )
    );
    echo '</tr></td>';
}
