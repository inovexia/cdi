$(document).ready(function(){

    var states_json = country_js.countries.replace( /&quot;/g, '"' );
    var states = $.parseJSON( states_json );

    $('#mspa_country_field').on ('change', function () {
      var options = '';
      var country = $('#mspa_country_field').val ();
      var state = states[ country ];

      for( var index in state ) {
        if ( state.hasOwnProperty( index ) ) {
          options = options + '<option value="' + index + '">' + state[ index ] + '</option>';
        }
      }
      $('#mspa_state_field')
        .find('option')
        .remove()
        .end()
        .append(options);
    });

});
