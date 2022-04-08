<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Inovexia_WP_Starter
 */

/* cart page hooks */
add_action('woocommerce_after_cart', 'mspa_cart_page_custom_text');
function mspa_cart_page_custom_text() {

    $message = '<div class="cart-order-message mt-4">';

      $message .='<div class="">';
        $message .='<label>';
          $message .= '<input type="radio" name="drone" value="huey">';
          $message .= ' Place Order as Group Buy in order to get the special pricing and delivery with 7-10 business days. Learn more here.</label>';
      $message .= '</div>';

      $message .='<div class="">';
        $message .='<label>';
          $message .= '<input type="radio" name="drone" value="huey" checked>';
          $message .= ' Place normal order and have it delivered as soon as possible.';
          $message .= '</label>';
        $message .='</div>';

    $message .='</div>';

    echo $message;
}
