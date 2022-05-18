// Perform AJAX login on form submit - CHECKOUT PAGE ONLY
jQuery(document).ready(function($) {
  $('#mspa-groupbuy-select').click(function(){
    if ($(this).is(':checked')) {
      let update_cart = $('.update_cart');
      update_cart.prop('disabled', false).trigger('click');
      //$('.woocommerce-cart-form').submit ();
    }
  });

  $('#mspa-normal-select').click(function(){
    if ($(this).is(':checked')) {
      let update_cart = $('.update_cart');
      update_cart.prop('disabled', false).trigger('click');
      //$('.woocommerce-cart-form').submit ();
    }
  });

});
