/* Registration modal steps */
$(document).ready(function () {
	var currentGfgStep, nextGfgStep, previousGfgStep;
	var opacity;
	var current = 1;
	var steps = $("#custom-registration-tabs fieldset.crf-tab").length;

	// Goto next step
	$("#custom-registration-tabs fieldset.crf-tab .next-step").click(function (e) {

		e.preventDefault ();
		var elem = '#custom-registration-tabs fieldset.crf-tab .next-step';
		// Get the text-value of button
		var text_val = $(this).text ();
		// Disable the button
		$(this).prop("disabled", true);
		// Show loading spinner
		$(this).html ('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
		// Show a loading message from backend
		//$('#custom-registration-tabs p.status').show().html(loadingmessage);

		// Start tab show-hide snippet
		currentGfgTab = $(this).attr('data-toggle');
		nextGfgTab = parseInt(currentGfgTab) + parseInt(1);

		currentGfgStep = '#crf-step'+currentGfgTab;
		nextGfgStep = '#crf-step'+nextGfgTab;

		$('#current_tab').val (currentGfgTab);

		// Validate before moving to next step
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
				success: function(data) {
					/* We got some response from server. */
					// Enable the button
					$(elem).removeAttr("disabled");
					// Show original button text
					$(elem).html (text_val);

					$('#custom-registration-tabs p.status').text(data.message);
					if (data.error == false ) {
						if (data.current_tab == 'finish') {
							var thanks_message = '<p class="text-white"><i class="fa fa-ok fa-3x"></i></p><h3>Thanks for your information!</h3> <span>Your information has been saved! We will contact you shortly!</p>';
							$('#thanks-message').html (thanks_message);
						} else {
							$(nextGfgStep).addClass("active");

							$(nextGfgStep).show();
							$(currentGfgStep).animate({ opacity: 0 }, {
								step: function (now) {
									opacity = 1 - now;

									$(currentGfgStep).css({
										'display': 'none',
										'position': 'relative'
									});
									$(nextGfgStep).css({ 'opacity': opacity });
								},
								duration: 500
							});

						}
					}
				}
	 	});

	});

	// Goto previous step
	$("#custom-registration-tabs fieldset.crf-tab .previous-step").click(function () {

		currentGfgTab = $(this).attr('data-toggle');
		previousGfgTab = parseInt(currentGfgTab) - parseInt(1);

		currentGfgStep = '#crf-step'+currentGfgTab;
		previousGfgStep = '#crf-step'+previousGfgTab;

		if (currentGfgTab > 1) {

			$(previousGfgStep).show();

			$(currentGfgStep).animate({ opacity: 0 }, {
				step: function (now) {
					opacity = 1 - now;

					$(currentGfgStep).css({
						'display': 'none',
						'position': 'relative'
					});
					$(previousGfgStep).css({ 'opacity': opacity });
				},
				duration: 500
			});
		}
		//setProgressBar(--current);
	});

});
