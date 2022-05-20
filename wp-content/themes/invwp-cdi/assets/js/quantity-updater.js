jQuery(function($) {

  // Add to cart functionality on all  products page
  $(document.body).on("added_to_cart", function( response ) {
    // Show mini cart
    var miniCartOffcanvas = document.getElementById('offcanvas-mini-cart');
    var bsOffcanvas = new bootstrap.Offcanvas(miniCartOffcanvas);
    bsOffcanvas.show ();
  });

  // Add to cart functionality on product single page
  $('form.cart').on( 'click', 'button.plus, button.minus', function() {
      // Get current quantity values
      var qty = $( this ).closest( 'form.cart' ).find( '.qty' );
      var val   = parseFloat(qty.val());
      var max = parseFloat(qty.attr( 'max' ));
      var min = parseFloat(qty.attr( 'min' ));
      var step = parseFloat(qty.attr( 'step' ));

      // Change the value if plus or minus
      if ( $( this ).is( '.plus' ) ) {
         if ( max && ( max <= val ) ) {
            qty.val( max );
         } else {
            qty.val( val + step );
         }
      } else {
         if ( min && ( min >= val ) ) {
            qty.val( min );
         } else if ( val > 1 ) {
            qty.val( val - step );
         }
      }
  });


  // Update cart quantity functionality on cart page
  $( document ).on( 'change', '.qty', function () {
    setTimeout(function() {
      $("[name=update_cart]").prop("disabled", false);
      $("[name=update_cart]").prop("aria-disabled", false);
      $("[name=update_cart]").trigger("click");
    }, 1000 ); // 1 second delay, half a second (500) seems comfortable too
  } );

  $(document).on('click', 'button.plus, button.minus', function() {
      var timeout;
      // Get current quantity values
      var qty = $( this ).closest( 'form.woocommerce-cart-form' ).find( '.qty' );
      var val   = parseFloat(qty.val());
      var max = parseFloat(qty.attr( 'max' ));
      var min = parseFloat(qty.attr( 'min' ));
      var step = parseFloat(qty.attr( 'step' ));

      // Change the value if plus or minus
      if ( $( this ).is( '.plus' ) ) {
         if ( max && ( max <= val ) ) {
            qty.val( max );
         } else {
            qty.val( val + step );
         }
      } else {
         if ( min && ( min >= val ) ) {
            qty.val( min );
         } else if ( val > 1 ) {
            qty.val( val - step );
         }
      }

      if ( timeout !== undefined ) {
        clearTimeout( timeout );
      }

      timeout = setTimeout(function() {
        $("[name=update_cart]").prop("disabled", false);
        $("[name=update_cart]").prop("aria-disabled", false);
        $("[name=update_cart]").trigger("click");
      }, 1000 ); // 1 second delay, half a second (500) seems comfortable too
      //setInterval('location.reload()', 1000);
  });


  // Update cart quantity functionality on mini-cart
  $('#offcanvas-mini-cart .cart-plus-minus-icon').on('click', function() {
    var timeout;
    valueElementH = $(this).parent().find('.cart-item-quantity');
    valueElementD = $(this).parent().find('.cart-item-quantity-span');
    value = parseInt(valueElementH.val());
    var item_hash = valueElementH.attr( 'name' ).replace(/cart\[([\w]+)\]\[qty\]/g, "$1");

    if ($(this).hasClass('plus')) {
      valueElementH.val(value + 1);
      valueElementD.html(value + 1);
    } else {
      if (value > 1) {
        valueElementH.val(value - 1);
        valueElementD.html(value - 1);
      }
    }

    if ( timeout !== undefined ) {
      clearTimeout( timeout );
    }

    currentVal = valueElementH.val();

    timeout = setTimeout(function() {
      $('form.woocommerce-cart-form').block({ message: null, overlayCSS: { background: '#fff', opacity: 0.6 } });

      $.ajax({
          type: 'POST',
          url: spa.ajax_url,
          data: {
              action: 'mspa_update_quantity',
              hash: item_hash,
              quantity: currentVal
          },
          success: function(response) {
            $('.cart-items-count').text (response.count);
            $('.woocommerce-mini-cart__total').html (response.subtotal);
          }
      });

      $('form.woocommerce-cart-form ').unblock();

    }, 1000 ); // 1 second delay, half a second (500) seems comfortable too

  });



  // Add to cart functionality on single product page
  $('form.cart').on('submit', function(e) {
    e.preventDefault();

    var form = $(this);
    form.block({ message: null, overlayCSS: { background: '#fff', opacity: 0.6 } });

    var formData = new FormData(form[0]);
    formData.append('add-to-cart', form.find('[name=add-to-cart]').val() );

    // Ajax action.
    $.ajax({
      url: wc_add_to_cart_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'mspa_add_to_cart' ),
      data: formData,
      type: 'POST',
      processData: false,
      contentType: false,
      complete: function( response ) {
        response = response.responseJSON;
        //$ ('.cart-items-count').text (str);

        if ( ! response ) {
          return;
        }

        if ( response.error && response.product_url ) {
          window.location = response.product_url;
          return;
        }

        // Redirect to cart option
        if ( wc_add_to_cart_params.cart_redirect_after_add === 'yes' ) {
          window.location = wc_add_to_cart_params.cart_url;
          return;
        }

        var $thisbutton = form.find('.single_add_to_cart_button'); //
        $thisbutton.html ('Add to cart &nbsp;<i class="text-white fas fa-check"></i>');

        //	var $thisbutton = null; // uncomment this if you don't want the 'View cart' button

        // Trigger event so themes can refresh other areas.
        $( document.body ).trigger( 'added_to_cart', [ response.fragments, response.cart_hash, $thisbutton ] );

        // Remove existing notices
        $( '.woocommerce-error, .woocommerce-message, .woocommerce-info' ).remove();

        // Add new notices
        form.closest('.product').before(response.fragments.notices_html);

        // Refresh cart item count
        $('.cart-items-count').text (response.fragments.cart_items_count);

        // Refresh mini cart content
        const fragments_array = Object.values(response.fragments);
        $('#mini-cart-content').html (fragments_array[0]);

        // Show mini cart
        var miniCartOffcanvas = document.getElementById('offcanvas-mini-cart');
        var bsOffcanvas = new bootstrap.Offcanvas(miniCartOffcanvas);
        bsOffcanvas.show ();

        form.unblock();
      }
    });
  });

});
