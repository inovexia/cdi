<?php

// The code for displaying WooCommerce Product Custom Fields
add_action('woocommerce_product_options_general_product_data', 'woocommerce_product_custom_fields');

function woocommerce_product_custom_fields() {
    global $woocommerce, $post;
    echo '<div class="product_groupbuy_field">';
    //Custom Product Number Field
    woocommerce_wp_text_input(
        array(
            'id' => '_mspa_product_groupbuy_field',
            'placeholder' => 'Enter Group Buy Price',
            'label' => __('Group Buy Price', 'woocommerce'),
            'type' => 'number',
            'custom_attributes' => array(
                'step' => 'any',
                'min' => '0'
            )
        )
    );
    echo '</div>';
}

// Save Fields
add_action('woocommerce_process_product_meta', 'woocommerce_product_custom_fields_save');
function woocommerce_product_custom_fields_save ($post_id) {

    // Product Group Buy Field
    $woocommerce_poduct_groupbuy_field = $_POST['_mspa_product_groupbuy_field'];
    if (!empty($woocommerce_poduct_groupbuy_field)) {
      update_post_meta($post_id, '_mspa_product_groupbuy_field', esc_attr($woocommerce_poduct_groupbuy_field));
    }

}

add_action('wp_enqueue_scripts', 'mspa_cart_ajax_scripts');
function mspa_cart_ajax_scripts() {
    // Here you register your script located in a subfolder `js` of your active theme
    wp_enqueue_script( 'product-group-buy', get_template_directory_uri().'/assets/js/product-group-buy.js', array('jquery'), '1.0', true );
    // Here you are going to make the bridge between php and js
    //wp_localize_script( 'cart-ajax-script', 'cart_ajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}

//remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');
//add_action('woocommerce_after_cart_table', 'woocommerce_cross_sell_display');

//remove_action('woocommerce_cart_collaterals', 'woocommerce_cart_totals');
//add_action('woocommerce_after_cart_table', 'woocommerce_cart_totals');

add_action('invwp_woocommerce_product_group_buy', 'mspa_cart_page_group_buy_selector');
function mspa_cart_page_group_buy_selector() {

    $message='<div class="cart-custom-message">';
        $message .= '<label class="">';
          $message .= '<input type="radio" id="mspa-groupbuy-select" name="mspa_groupbuy_select" value="groupbuy" ';
            if ( isset( $_POST['mspa_groupbuy_select'] ) && $_POST['mspa_groupbuy_select'] == 'groupbuy') {
              $message .= 'checked';
            }
          $message .= ' > ';
          //$message .= '<span class="text-muted text-decoration-line-through">';
            $message .= ' Place order as <strong>Group Buy</strong> in order to get the special pricing and delivery with 7-10 business days.';
          //$message .= '</span> ';
          $message .= '<a href="'.get_permalink (get_page_by_path( 'group-buy')).'"> Learn more here.</a>';
        $message .= '</label>';
        $message .= '<br>';
        $message .= '<label>';
          $message .= '<input type="radio" id="mspa-normal-select" name="mspa_groupbuy_select" value="normal" ';
            if ( (isset( $_POST['mspa_groupbuy_select'] ) && $_POST['mspa_groupbuy_select'] == 'normal') ||
                 ! isset ($_POST['mspa_groupbuy_select'])) {
             $message .= 'checked';
            }
          $message .= '> ';
          $message .= 'Place normal order and have it delivered as soon as possible.';
        $message .= '</label>';
    $message .= '</div>';

    echo $message;
}


add_filter( 'woocommerce_update_cart_action_cart_updated', 'mspa_add_cart_groupbuy_data', 10, 2 );
function mspa_add_cart_groupbuy_data ( $cart_item_data ) {

  $cart = WC()->cart->cart_contents;
  foreach( $cart as $cart_item_key => $cart_item ) {
    $product = $cart_item['data'];
    $product_id = $cart_item['product_id'];
    if ( isset( $_POST['mspa_groupbuy_select'] ) && $_POST['mspa_groupbuy_select'] == 'groupbuy') {
      $groupbuy_price = get_post_meta ($product_id, '_mspa_product_groupbuy_field', true);
      if ($groupbuy_price) {
        //$product->set_price( $groupbuy_price );
        $cart_item['groupbuy_price'] = $groupbuy_price;
        $cart_item['unique_key']   = md5(microtime().rand());
        WC()->cart->cart_contents[$cart_item_key] = $cart_item;
      }
    } else {
      unset ($cart_item['groupbuy_price']);
      unset ($cart_item['unique_key']);
      WC()->cart->cart_contents[$cart_item_key] = $cart_item;
    }
  }
  WC()->cart->set_session();
}

// Update price
add_action( 'woocommerce_before_calculate_totals', 'update_price_in_cart', 10, 1 );
function update_price_in_cart( $cart ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
        return;

    if ( did_action( 'woocommerce_before_calculate_totals' ) >= 2 )
        return;

    // Loop through cart items
    foreach( $cart->get_cart() as $cart_item ) {
        if( isset( $cart_item['groupbuy_price'] ) ) {
            // Add options to the product price
          $cart_item['data']->set_price( $cart_item['groupbuy_price'] );
        } else {
          $cart_item['data']->set_price( $cart_item['data']->get_regular_price() );
        }
    }
}

/**
 * Add custom meta to order
 */
add_action( 'woocommerce_checkout_create_order_line_item', 'mspa_checkout_create_order_line_item', 10, 4 );
function mspa_checkout_create_order_line_item( $item, $cart_item_key, $values, $order ) {
  if( isset( $values['mspa_groupbuy_select']) && $values['mspa_groupbuy_select'] == 'groupbuy' ) {
    $item->add_meta_data( 'mspa_groupbuy_product', 'groupbuy', true);
  }
}
