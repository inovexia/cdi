/* Checkout page steps */

$(document).ready(function () {
	var currentGfgStep, nextGfgStep, previousGfgStep;
	var opacity;
	var current = 1;
	var steps = $("#custom-checkout-progressbar fieldset.checkout-tab").length;

	//setProgressBar(current);

	$("#custom-checkout-progressbar fieldset.checkout-tab .next-step").click(function () {

		currentGfgStep = $(this).parent();
		nextGfgStep = $(this).parent().next();

		$("#custom-checkout-progressbar #progressbar li").eq($("#custom-checkout-progressbar fieldset.checkout-tab")
			.index(nextGfgStep)).addClass("active");

		nextGfgStep.show();
		currentGfgStep.animate({ opacity: 0 }, {
			step: function (now) {
				opacity = 1 - now;

				currentGfgStep.css({
					'display': 'none',
					'position': 'relative'
				});
				nextGfgStep.css({ 'opacity': opacity });
			},
			duration: 500
		});
		//setProgressBar(++current);
	});

	$("#custom-checkout-progressbar fieldset.checkout-tab .previous-step").click(function () {

		currentGfgStep = $(this).parent();
		previousGfgStep = $(this).parent().prev();

		$("#custom-checkout-progressbar #progressbar li").eq($("#custom-checkout-progressbar fieldset.checkout-tab")
			.index(currentGfgStep)).removeClass("active");

		previousGfgStep.show();

		currentGfgStep.animate({ opacity: 0 }, {
			step: function (now) {
				opacity = 1 - now;

				currentGfgStep.css({
					'display': 'none',
					'position': 'relative'
				});
				previousGfgStep.css({ 'opacity': opacity });
			},
			duration: 500
		});
		//setProgressBar(--current);
	});


	$(".submit").click(function () {
		return false;
	});
	// Checkout page steps functionality end

  // Show hide login-Registration form
  $('#join-action-link').on ('click', function () {
    $('#customer_register').removeClass ('d-none');
    $('#customer_login').addClass ('d-none');
  });

  $('#login-action-link').on ('click', function () {
    $('#customer_register').addClass ('d-none');
    $('#customer_login').removeClass ('d-none');
  });




});
