<section class="main-nav full-width">
  <div class="container">
    <nav id="site-navigation" class="navbar ">

      <div class="site-branding">
        <?php // the_custom_logo(); ?>
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="site-title"><?php bloginfo( 'name' ); ?></a>
        <?php
        /*
          $invwp_description = get_bloginfo( 'description', 'display' );
          if ( $invwp_description || is_customize_preview() ) :
            ?>
            <p class="site-description"><?php echo $invwp_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
          <?php endif;
        */
        ?>
      </div><!-- .site-branding -->

      <div class="nav-menu-container">
        <?php
        wp_nav_menu( array(
            'menu_class'     => 'nav-menu',
            'depth'          => 2,
            'container'      => 'div',
            'container_class' => '',
        ) );
        ?>

        <ul class="nav-menu-right">
          <li class="nav-item">
            <a href="#">SEARCH</a>
          </li>
          <li class="nav-item">
            <div class="dropdown">
              <?php if (is_user_logged_in()) { ?>
                <a href="#" class="dropbtn">My Account</a>
                <ul class="dropdown-content">
                  <?php if ( class_exists( 'WooCommerce' ) ) { ?>
                    <li><a class="dropdown-item" href="<?php echo wc_get_account_endpoint_url(''); ?>">Account Information</a></li>
                    <li><a class="dropdown-item" href="<?php echo wc_get_account_endpoint_url('orders'); ?>">My Orders</a></li>
                    <li><a class="dropdown-item" href="<?php echo wc_get_account_endpoint_url('edit-address'); ?>">Address Book</a></li>
                    <li><a class="dropdown-item" href="<?php echo wc_get_account_endpoint_url('payment-methods'); ?>">Payment Methods</a></li>
                    <li><hr class="dropdown-divider"></li>
                  <?php } ?>
                  <li><a class="dropdown-item" href="<?php echo wp_logout_url(home_url()); ?>"> Logout</a></li>
                </ul>
              <?php } else { ?>
                <nav class="cd-main-nav js-main-nav">
            			<ul class="cd-main-nav__list js-signin-modal-trigger">
            				<!-- inser more links here -->
            				<li><a class="login-modal cd-main-nav__item cd-main-nav__item--signin" href="#0" style="cursor:pointer;" data-signin="login">LOGIN</a></li>
            			</ul>
            		</nav>
              <?php } ?>
            </div>
          </li>

          <li class="nav-item">
            <?php if ( class_exists( 'WooCommerce' ) ) { ?>
              <a class="btn-bag" id="btn-bag" style="cursor:pointer;">
                <span class="bag">BAG</span>
                  <?php
                  global $woocommerce;
                  $item_count =  $woocommerce->cart->cart_contents_count;
                  if ($item_count > 9) {
                    $cart_items_count = '9+';
                  } else {
                    $cart_items_count = $item_count;
                  }
                  ?>
                  (<span class="cart-items-count"><?php echo $cart_items_count; ?></span>)
              </a>
            <?php } ?>
          </li>

        </ul>

      </div>

      <div class="menu-toggler" id="menu-toggler">
        <a href="#" class="toggle-icon" id="menu-toggler" onclick="toggle_menu ()">&#9776;</a>
      </div>

    </nav><!-- #site-navigation -->
  </div>
</section>

<!-- Modal -->
<div class="invx-signin-modal js-signin-modal"> <!-- this is the entire modal form, including the background -->
  <div class="invx-signin-modal__container"> <!-- this is the container wrapper -->
    <ul class="invx-signin-modal__switcher js-signin-modal-switcher js-signin-modal-trigger">
      <li><a href="#0" data-signin="login" data-type="login">LOGIN</a></li>
      <li><a href="#0" data-signin="signup" data-type="signup">SIGNUP</a></li>
    </ul>

    <div class="invx-signin-modal__block js-signin-modal-block" data-type="login"> <!-- log in form -->
      <!--<form class="invx-signin-modal__form">
        <p class="invx-signin-modal__fieldset">
          <label class="invx-signin-modal__label invx-signin-modal__label--email invx-signin-modal__label--image-replace" for="signin-email">E-mail</label>
          <input class="invx-signin-modal__input invx-signin-modal__input--full-width invx-signin-modal__input--has-padding invx-signin-modal__input--has-border" id="signin-email" type="email" placeholder="E-mail">
          <span class="invx-signin-modal__error">Error message here!</span>
        </p>

        <p class="invx-signin-modal__fieldset">
          <label class="invx-signin-modal__label invx-signin-modal__label--password invx-signin-modal__label--image-replace" for="signin-password">Password</label>
          <input class="invx-signin-modal__input invx-signin-modal__input--full-width invx-signin-modal__input--has-padding invx-signin-modal__input--has-border" id="signin-password" type="text"  placeholder="Password">
          <a href="#0" class="invx-signin-modal__hide-password js-hide-password">Hide</a>
          <span class="invx-signin-modal__error">Error message here!</span>
        </p>

        <p class="invx-signin-modal__fieldset">
          <input type="checkbox" id="remember-me" checked class="invx-signin-modal__input ">
          <label for="remember-me">Remember me</label>
        </p>

        <p class="invx-signin-modal__fieldset">
          <input class="invx-signin-modal__input invx-signin-modal__input--full-width" type="submit" value="Login">
        </p>
      </form>
      <p class="invx-signin-modal__bottom-message js-signin-modal-trigger"><a href="#0" data-signin="reset">Forgot your password?</a></p>-->
        <?php wc_get_template ('myaccount/custom-login-form.php'); ?>
        
      </div> <!-- invx-signin-modal__block -->

    <div class="invx-signin-modal__block js-signin-modal-block" data-type="signup"> <!-- sign up form -->
      <?php wc_get_template ('myaccount/custom-registration-form.php'); ?>
      <!-- <form class="invx-signin-modal__form">
        <p class="invx-signin-modal__fieldset">
          <label class="invx-signin-modal__label invx-signin-modal__label--username invx-signin-modal__label--image-replace" for="signup-username">Username</label>
          <input class="invx-signin-modal__input invx-signin-modal__input--full-width invx-signin-modal__input--has-padding invx-signin-modal__input--has-border" id="signup-username" type="text" placeholder="Username">
          <span class="invx-signin-modal__error">Error message here!</span>
        </p>

        <p class="invx-signin-modal__fieldset">
          <label class="invx-signin-modal__label invx-signin-modal__label--email invx-signin-modal__label--image-replace" for="signup-email">E-mail</label>
          <input class="invx-signin-modal__input invx-signin-modal__input--full-width invx-signin-modal__input--has-padding invx-signin-modal__input--has-border" id="signup-email" type="email" placeholder="E-mail">
          <span class="invx-signin-modal__error">Error message here!</span>
        </p>

        <p class="invx-signin-modal__fieldset">
          <label class="invx-signin-modal__label invx-signin-modal__label--password invx-signin-modal__label--image-replace" for="signup-password">Password</label>
          <input class="invx-signin-modal__input invx-signin-modal__input--full-width invx-signin-modal__input--has-padding invx-signin-modal__input--has-border" id="signup-password" type="text"  placeholder="Password">
          <a href="#0" class="invx-signin-modal__hide-password js-hide-password">Hide</a>
          <span class="invx-signin-modal__error">Error message here!</span>
        </p>

        <p class="invx-signin-modal__fieldset">
          <input type="checkbox" id="accept-terms" class="invx-signin-modal__input ">
          <label for="accept-terms">I agree to the <a href="#0">Terms</a></label>
        </p>

        <p class="invx-signin-modal__fieldset">
          <input class="invx-signin-modal__input invx-signin-modal__input--full-width invx-signin-modal__input--has-padding" type="submit" value="Create account">
        </p>
      </form>-->
    </div> <!-- invx-signin-modal__block -->

    <div class="invx-signin-modal__block js-signin-modal-block" data-type="reset"> <!-- reset password form -->
      <p class="invx-signin-modal__message">Lost your password? Please enter your email address. You will receive a link to create a new password.</p>

      <form class="invx-signin-modal__form">
        <p class="invx-signin-modal__fieldset">
          <label class="invx-signin-modal__label invx-signin-modal__label--email invx-signin-modal__label--image-replace" for="reset-email">E-mail</label>
          <input class="invx-signin-modal__input invx-signin-modal__input--full-width invx-signin-modal__input--has-padding invx-signin-modal__input--has-border" id="reset-email" type="email" placeholder="E-mail">
          <span class="invx-signin-modal__error">Error message here!</span>
        </p>

        <p class="invx-signin-modal__fieldset">
          <input class="invx-signin-modal__input invx-signin-modal__input--full-width invx-signin-modal__input--has-padding" type="submit" value="Reset password">
        </p>
      </form>

      <p class="invx-signin-modal__bottom-message js-signin-modal-trigger"><a href="#0" data-signin="login">Back to log-in</a></p>
    </div> <!-- invx-signin-modal__block -->
    <a href="#0" class="invx-signin-modal__close js-close">Close</a>
  </div> <!-- invx-signin-modal__container -->
</div> <!-- invx-signin-modal -->
