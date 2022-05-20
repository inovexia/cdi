<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$allowed_html = array(
	'a' => array(
		'href' => array(),
	),
);

$customer_id = get_current_user_id();

if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing'  => __( 'Billing address', 'woocommerce' ),
			'shipping' => __( 'Shipping address', 'woocommerce' ),
		),
		$customer_id
	);
} else {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing' => __( 'Billing address', 'woocommerce' ),
		),
		$customer_id
	);
}

?>
<div class="row">
		<h4 class="addresses-bill-ship-title">Account Information </h4>
		<div class="col-12 px-0">

			<div class="post-column addresses-bill-ship">
				<div class="row my-5">
					<div class="col-6">
						<h4 class="contact-information">CONTACT INFORMATION </h4>
						 <?php $current_userfullname = $current_user->user_firstname .'&nbsp;'.$current_user->user_lastname;
						 ?>
						<p class="name-maria-murillo my-5">Name:  <?php echo $current_userfullname;
						//echo $current_user->display_name; ?></p>
						<p class="name-maria-murillo my-5">Email: <?php echo $current_user->user_email; ?></p>
					</div>
					<div class="col-6">
						<h4 class="contact-information">NEWSLETTER </h4>
						<p class="text-97 my-5">You are subscribe to our newsletter.</p>
					</div>
				</div>
			</div>

		</div>

	</div>
	<div class="row">
		<h4 class="addresses-bill-ship-title">Addresses </h4>
		<div class="col-12 px-0">
			<div class="post-column addresses-bill-ship">
				<div class="row my-5">
					<?php foreach ( $get_addresses as $name => $address_title ) : ?>
					<?php
						$address = wc_get_account_formatted_address( $name );
					?>
					<div class="col-6">
						<h4 class="addresses-bill-ship contact-information">BILLING ADDRESS </h4>
						<p class="text-97 my-5"><?php echo $address ? wp_kses_post( $address ) : esc_html_e( 'You have not set a shipping address yet.', 'woocommerce' ); ?></p>
					</div>
					<?php endforeach; ?>
				</div>
			</div>

		</div>

	</div>

<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
