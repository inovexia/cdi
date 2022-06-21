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
  <style>
    button[name=update_cart] {
      display: none;
    }
   </style>
   <?php
}

add_action( 'wp_footer', 'add_cart_quantity_plus_minus' );
function add_cart_quantity_plus_minus() {
  // Only run this on single product page
  if (is_product ()) {
    wc_enqueue_js ('
      // Quantity updater on product single page
      $("form.cart").on("click", "button.plus, button.minus", function () {
        // Get current quantity values
        var qty = $(this).parent().find(".qty");
        var val = parseFloat(qty.val());
        var max = parseFloat(qty.attr("max"));
        var min = parseFloat(qty.attr("min"));
        var step = parseFloat(qty.attr("step"));

        // Change the value if plus or minus
        if ($(this).is(".plus")) {
          if (max && max <= val) {
            qty.val(max);
          } else {
            qty.val(val + step);
          }
        } else {
          if (min && min >= val) {
            qty.val(min);
          } else if (val > 1) {
            qty.val(val - step);
          }
        }
      });

      // Add to cart functionality on single product page
      $("form.cart").on("submit", function (e) {
        e.preventDefault();

        var form = $(this);
        form.block({
          message: null,
          overlayCSS: { background: "#fff", opacity: 0.6 },
        });

        var formData = new FormData(form[0]);
        formData.append("add-to-cart", form.find("[name=add-to-cart]").val());

        // Ajax action.
        $.ajax({
          url: wc_add_to_cart_params.wc_ajax_url
            .toString()
            .replace("%%endpoint%%", "mspa_add_to_cart"),
          data: formData,
          type: "POST",
          processData: false,
          contentType: false,
          complete: function (response) {
            response = response.responseJSON;
            //$ (".cart-items-count").text (str);

            if (!response) {
              return;
            }

            if (response.error && response.product_url) {
              window.location = response.product_url;
              return;
            }

            // Redirect to cart option
            if (wc_add_to_cart_params.cart_redirect_after_add === "yes") {
              window.location = wc_add_to_cart_params.cart_url;
              return;
            }

            var $thisbutton = form.find(".single_add_to_cart_button"); //
            $thisbutton.html(
              "Added to cart &nbsp;<i class=\"text-white fas fa-check\"></i>"
            );

            //	var $thisbutton = null; // uncomment this if you dont want the View cart button

            // Trigger event so themes can refresh other areas.
            $(document.body).trigger("added_to_cart", [
              response.fragments,
              response.cart_hash,
              $thisbutton,
            ]);

            // Remove existing notices
            $(
              ".woocommerce-error, .woocommerce-message, .woocommerce-info"
            ).remove();

            // Add new notices
            form.closest(".product").before(response.fragments.notices_html);

            // Refresh cart item count
            $(".cart-items-count").text(response.fragments.cart_items_count);

            // Refresh mini cart content
            const fragments_array = Object.values(response.fragments);
            $("#mini-cart-content").html(fragments_array[0]);

            form.unblock();
          },
        });
      });
    ');

    ?>
    <script type="text/javascript">

    </script>
    <?php
  }

  // Only run this on cart page
  if (is_cart() || (is_cart() && is_checkout ()) )  {
    wc_enqueue_js ('
      // Quantity updater on Cart page - This will change the quantity and update the cart through ajax
      $(document).on("click", "button.plus, button.minus", function () {
          var timeout;
        // Get current quantity values
        var qty = $(this).parent().find(".qty");
        var val = parseFloat(qty.val());
        var max = parseFloat(qty.attr("max"));
        var min = parseFloat(qty.attr("min"));
        var step = parseFloat(qty.attr("step"));

        // Change the value if plus or minus
        if ($(this).is(".plus")) {
          if (max && max <= val) {
            qty.val(max);
          } else {
            qty.val(val + step);
          }
        } else {
          if (min && min >= val) {
            qty.val(min);
          } else if (val > 1) {
            qty.val(val - step);
          }
        }

        if (timeout !== undefined) {
          clearTimeout(timeout);
        }

        timeout = setTimeout(function () {
          $("[name=update_cart]").prop("disabled", false);
          $("[name=update_cart]").prop("aria-disabled", false);
          $("[name=update_cart]").trigger("click");
        }, 500); // 1 second delay, half a second (500) seems comfortable too
      });
    ');
  }

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
