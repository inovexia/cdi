<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Inovexia_WP_Starter
 */

 /* Show Buttons */
add_action( 'woocommerce_before_quantity_input_field', 'display_quantity_minus' );
function display_quantity_minus() {
   echo '<button type="button" class="qty-updater minus" >-</button>';
}

add_action( 'woocommerce_after_quantity_input_field', 'display_quantity_plus' );
function display_quantity_plus() {
   echo '<button type="button" class="qty-updater plus" >+</button>';
}

add_action( 'wp_head', 'hide_update_cart_button' );
function hide_update_cart_button() {
  ?>
  <style media="screen">
    button[name=update_cart] {
      display: none;
    }
   </style>
   <?php
}

add_action( 'wp_footer', 'add_cart_quantity_plus_minus' );
function add_cart_quantity_plus_minus() {
  // Only run this on the single product page
  //if ( ! is_product() || ! is_page ('cart')) return;
  ?>
   <script type="text/javascript" src="<?php echo get_template_directory_uri () .'/assets/js/quantity-updater.js'; ?>">
   </script>
   <?php
}

//add_filter( 'woocommerce_widget_cart_item_quantity', 'add_minicart_quantity_fields', 10, 3 );
function add_minicart_quantity_fields( $html, $cart_item, $cart_item_key ) {
    $product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $cart_item['data'] ), $cart_item, $cart_item_key );

    return woocommerce_quantity_input( array('input_value' => $cart_item['quantity']), $cart_item['data'], false ) . $product_price;
}

/* cart page hooks */
add_action( "wp_ajax_nopriv_mspa_update_quantity", 'mspa_update_quantity');
add_action( "wp_ajax_mspa_update_quantity", 'mspa_update_quantity');

// Update quantity function. called through ajax on cart and mini-cart pages
function mspa_update_quantity() {

    // Set item key as the hash found in input.qty's name
    $cart_item_key = $_POST['hash'];

    // Get the array of values owned by the product we're updating
    $product_values = WC()->cart->get_cart_item( $cart_item_key );

    // Get the quantity of the item in the cart
    $product_quantity = apply_filters( 'woocommerce_stock_amount_cart_item', apply_filters( 'woocommerce_stock_amount', preg_replace( "/[^0-9\.]/", '', filter_var($_POST['quantity'], FILTER_SANITIZE_NUMBER_INT)) ), $cart_item_key );

    // Update cart validation
    $passed_validation  = apply_filters( 'woocommerce_update_cart_validation', true, $cart_item_key, $product_values, $product_quantity );

    if ( is_page( 'cart' ) || is_cart() ) {
      $redirect = wc_get_cart_url();
    } else {
      $redirect = '';
    }

    // Update the quantity of the item in the cart
    if ( $passed_validation ) {
        WC()->cart->set_quantity( $cart_item_key, $product_quantity, true );
        wp_send_json([
          'count' => WC()->cart->get_cart_contents_count(),
          'subtotal' => '<strong>Subtotal</strong>' . WC()->cart->get_cart_subtotal(),
          'redirect' => $redirect,
        ]);
    }
}
