
const loadingmessage = '<div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div> ';

// Perform AJAX login on form submit - CHECKOUT PAGE ONLY
jQuery(document).ready(function($) {
  $('form#checkout-custom-login-form').on('submit', function(e){
    e.preventDefault();
      $('form#checkout-custom-login-form p.status').show().html(loadingmessage);
      $.ajax({
          type: 'POST',
          dataType: 'json',
          url: ajax_login_object.ajaxurl,
          data: {
              'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
              'username': $('form#checkout-custom-login-form #username').val(),
              'password': $('form#checkout-custom-login-form #password').val(),
              'security': $('form#checkout-custom-login-form #security').val()
          },
          success: function(data){
              $('form#checkout-custom-login-form p.status').text(data.message);
              if (data.loggedin == true){
                  document.location.href = ajax_login_object.redirecturl;
              }
          }
      });
  });
});

// Perform AJAX Registration on form submit - CHECKOUT PAGE ONLY
jQuery(document).ready(function() {
  $('form#user-custom-register-form').on('submit', function(e) {
    e.preventDefault();
    $('form#user-custom-register-form p.status').show().html(loadingmessage);
    var myform = document.getElementById("user-custom-register-form");
    var formData = new FormData (myform);
    $.ajax({
      type: 'POST',
      dataType: 'json',
      url: ajax_login_object.ajaxurl,
      data: formData,
      cache: false,
      processData: false,
      contentType: false,
      success: function(data){
        $('form#user-custom-register-form p.status').text(data.message);
        if (data.error == false) {
          document.location.href = ajax_login_object.redirecturl;
        }
      }
    });
  });
});




 /*
*/
