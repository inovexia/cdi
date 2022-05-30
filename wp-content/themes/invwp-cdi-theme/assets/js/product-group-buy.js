// Perform AJAX login on form submit - CHECKOUT PAGE ONLY
jQuery(document).ready(function($) {
  $('#mspa-groupbuy-select').click(function(){
    if ($(this).is(':checked')) {
      timeout = setTimeout(function () {
        $("[name=update_cart]").prop("disabled", false);
        $("[name=update_cart]").prop("aria-disabled", false);
        $("[name=update_cart]").trigger("click");
      }, 1000); // 1 second delay, half a second (
    }
  });

  $('#mspa-normal-select').click(function(){
    if ($(this).is(':checked')) {
      timeout = setTimeout(function () {
        $("[name=update_cart]").prop("disabled", false);
        $("[name=update_cart]").prop("aria-disabled", false);
        $("[name=update_cart]").trigger("click");
      }, 1000); // 1 second delay, half a second (
    }
  });
});
