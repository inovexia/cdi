<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

<?php endif; ?>

<div class="" id="customer_login">
  <h2 class=""><?php esc_html_e( 'Login to your account', 'woocommerce' ); ?></h2>

  <form class="woocommerce-form woocommerce-form-login woocommerce-checkout-custom-login-form login" method="post" id="checkout-custom-login-form">

    <?php do_action( 'woocommerce_login_form_start' ); ?>

    <div class=" form-group row">
      <div class="col-12">
        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text form-control" name="username" id="username" autocomplete="username"
          value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" placeholder="Your username" /><?php // @codingStandardsIgnoreLine ?>
      </div>
    </div>

    <div class=" form-group row d-md-none pass-input-mobile">
      <div class="col-12">
        <input class="woocommerce-Input woocommerce-Input--text input-text form-control" type="password" name="password" id="password" autocomplete="current-password" placeholder="Your Password" />
        <a class="lost" href="<?php echo wp_lostpassword_url(); ?>">Forgot your password?</a>
      </div>
      <!-- <div class="col-md-4 checkout-login-width">
        <div class="woocommerce-form-row forgot-pass-btn form-row ">

        </div>
      </div> -->
    </div>

    <!-- --------------------------------only for desktop------------------------------ -->

    <div class=" form-group row pass-input-desktop">
      <div class="col-8">
        <input class="woocommerce-Input woocommerce-Input--text input-text form-control" type="password" name="password" id="password" autocomplete="current-password" placeholder="Your Password" />
      </div>
      <div class="col-4 checkout-login-width">
        <div class="woocommerce-form-row forgot-pass-btn form-row ">
          <a class="lost" href="<?php echo wp_lostpassword_url(); ?>">Forgot your password?</a>
        </div>
      </div>
    </div>

    <?php do_action( 'woocommerce_login_form' ); ?>

    <p class="form-row mb-3">
      <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
        <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span
          class="remember-sec"><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
      </label>
    </p>

    <div class="woocommerce-form-row form-row">
      <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
      <button type="submit" class="woocommerce-button button woocommerce-form-login__submit sign-in button-background-blue" name="login" value="<?php esc_attr_e( 'Sign in', 'woocommerce' ); ?>"
        id="checkout-custom-submit"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>
    </div>

    <p class="status"></p>

    <?php do_action( 'woocommerce_login_form_end' ); ?>

    <div class="woocommerce-form-row form-row">
      <p class="text-center align-center">Don't have an account yet? <a href="#customer_register" class=""
          id="join-action-link">Join Medmonarch </a></p>
    </div>

  </form>

</div>


<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
