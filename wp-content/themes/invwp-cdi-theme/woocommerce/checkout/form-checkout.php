<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>

<section id="custom-checkout-progressbar">

  <div class="row">
    <div class="col-9">

			<div class="row">
	      <div class="col-12">
	        <ul id="progressbar">
	            <li class="step-progress active <?php if (! is_user_logged_in ()) { echo 'active';} ?>" id="step1">
	                <strong class="">Account</strong>
	            </li>
	            <li class="step-progress <?php if (is_user_logged_in ()) { echo 'active';} ?>" id="step2">
	                <strong class="">Shipping</strong>
	            </li>
	            <li class="step-progress" id="step3">
								<strong class="">Payment</strong>
							</li>
	            <li class="step-progress" id="step4">
								<strong class="">Review</strong>
							</li>
	        </ul>
				</div>
			</div>

	    <div class="clearfix"></div>

			<div class="row">
	      <div class="col-12">

						<!-- Login Block -->
	          <fieldset id="fieldset1" class="checkout-tab">
	              <?php
								// If checkout registration is disabled and not logged in, the user cannot checkout.
								if ( ! is_user_logged_in() ) {

									//do_action ('invwp_woocommerce_checkout_login_form');

									wc_get_template( 'myaccount/checkout-login-form.php', array(
										'redirect' => wc_get_page_permalink( 'checkout' ),
										'hidden'   => false,
									));

									/*
									wc_get_template( 'myaccount/checkout-registration-form.php', array(
										'redirect' => wc_get_page_permalink( 'checkout' ),
										'hidden'   => false,
									));
									*/
								}
								?>
	          </fieldset>
	          <!--//  Login Block -->

						<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

							<!--  Address Block -->
							<fieldset id="fieldset2" class="checkout-tab">
								<?php if ( $checkout->get_checkout_fields() ) : ?>

									<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

									<div class="col2-set" id="customer_details">
										<div class="col-1-full">
											<?php do_action( 'woocommerce_checkout_billing' ); ?>
										</div>

										<div class="col-2-full">
											<?php do_action( 'woocommerce_checkout_shipping' ); ?>
										</div>
									</div>

									<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

									<div class="clearfix"></div>

									<button type="button" class="wc-forward next-step button button-primary text-uppercase"
											id="checkout-review-order-button">Next: Payment </button>
									<?php endif; ?>

							</fieldset>

							<!--  Payment Block -->
		          <fieldset id="fieldset3" class="checkout-tab">
		              <h2>Payment Details</h2>
		              <?php do_action( 'invwp_woocommerce_payment_methods' ); ?>
		              <p class="mt-4"></p>
		              <button type="button" id="rev-order" class="rev-order wc-forward next-step button button-primary text-uppercase">Review Order</button>
		          </fieldset>
		          <!--//  Payment Block -->

							<!--  Review Block -->
							<fieldset id="fieldset4" class="checkout-tab">
								<h2>Review Order</h2>
                <div class="row checkout-order-review-shipping-block">
                    <div class="review-left">
                        <strong>Shipping address:</strong>
                        <div id="shipping-address-line1" class="montserrat-normal-ebony-clay-10px"></div>
                        <div id="shipping-address-line2" class="montserrat-normal-ebony-clay-10px">
                            <span id="shipping-address-zipcode"></span>
                            <span id="shipping-address-city"></span>
                            <span id="shipping-address-state"></span>
                        </div>
                        <div id="shipping-address-line3" class="montserrat-normal-ebony-clay-10px">
                            <span id="shipping-address-canada"></span>
                        </div>
                        <div><a href="#" id="edit-shipping-tab">Edit</a></div>
                    </div>

                    <div class="review-right">
                        <strong>Payment method:</strong>
                        <div id="shipping-payment-line1" class="montserrat-normal-ebony-clay-10px"></div>
                        <div id="shipping-payment-line2" class="montserrat-normal-ebony-clay-10px"></div>
                        <div id="shipping-payment-line3" class="montserrat-normal-ebony-clay-10px"></div>
                        <div><a href="#" id="edit-payment-tab">Edit</a></div>
                    </div>
                </div>

                <div class="row checkout-order-review-email-block">
                    <div class="review-bottom">
                        <strong>Email address:</strong>
                        <div id="shipping-email-line1" class="montserrat-normal-ebony-clay-10px"></div>
                    </div>
                </div>

								<div class="final-step-place-order">
									<?php do_action ('invwp_woocommerce_checkout_place_order_button'); ?>
								</div>
							</fieldset>
						</form>

					</div>
				</div>
			</div>

			<div class="col-3">

				<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>

				<h3 id="order_review_heading"><?php esc_html_e( 'Your order', 'woocommerce' ); ?></h3>

				<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

				<div id="order_review" class="woocommerce-checkout-review-order">
					<?php do_action( 'woocommerce_checkout_order_review' ); ?>
				</div>

				<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

			</div>
		</div>


</section>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
<script>
$(document).ready(function() {
    <?php if (is_user_logged_in ()) { ?>
    $('#fieldset1').hide();
    $('#fieldset2').show();
    $('#fieldset3').hide();
    $('#fieldset4').hide();
    <?php } else { ?>
    $('#fieldset1').show();
    $('#fieldset2').hide();
    $('#fieldset3').hide();
    $('#fieldset4').hide();
    <?php } ?>

    $('#checkout-review-order-button').on('click', function() {
        $('#shipping-address-line1').html($('#billing_address_1').val());
        $('#shipping-address-zipcode').html($('#billing_postcode').val());
        $('#shipping-address-city').html($('#billing_city').val());
        $('#shipping-address-state').html($('#billing_state').val());
        $('#shipping-address-line3').html($('#billing_country').val());

        var payment_method = $('input[name=payment_method]:checked').val();
        if (payment_method == 'bacs') {
            payment_desc = 'Credit Card';
        } else {
            payment_desc = 'Credit Card';
        }
        var a1 = $('#offline_cc-card-holder').val();
        var a2 = $('#offline_cc-card-number').val();
        var a3 = $('#offline_cc-card-expiry').val();

        // $('#shipping-payment-line1').html(a1);
        // $('#shipping-payment-line2').html(a2);
        // $('#shipping-payment-line3').html(a3);

        // $('#shipping-payment-line1').html(payment_desc);
        // $('#shipping-payment-line2').html($('#billing_country').val());
        // $('#shipping-payment-line3').html($('#billing_country').val());

        $('#shipping-email-line1').html($('#billing_email').val());
    });
    $('#rev-order').on('click', function() {
        var ccn = $('#offline_cc-card-number').val();
        var cn = ccn.substr(-4);
        $('#shipping-payment-line1').html($('#offline_cc-card-holder').val());
        $('#shipping-payment-line2').html(cn);
        $('#shipping-payment-line3').html("Expires" +
            " " + $('#offline_cc-card-expiry').val());
    });

    $('#edit-shipping-tab').on('click', function() {
        $('#fieldset1').hide();
        $('#fieldset3').hide();
        $('#fieldset4').hide();

        $('#fieldset2').show();
        $('#fieldset2').css({
            "opacity": "1",
            "position": "relative"
        });


        $('#step2').addClass('active');
        $('#step3').removeClass('active');
        $('#step4').removeClass('active');

    });

    $('#edit-payment-tab').on('click', function() {
        $('#fieldset1').hide();
        $('#fieldset2').hide();
        $('#fieldset4').hide();

        $('#fieldset3').show();
        $('#fieldset3').css({
            "opacity": "1",
            "position": "relative"
        });


        $('#step3').addClass('active');
        $('#step4').removeClass('active');

    });
});
</script>
