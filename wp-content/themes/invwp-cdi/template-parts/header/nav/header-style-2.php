<section class="full-width">
  <div class="container">
    <div class="site-branding">
      <?php
      the_custom_logo();
      if ( is_front_page() && is_home() ) :
        ?>
        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
        <?php
      else :
        ?>
        <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
        <?php
      endif;
      $invwp_description = get_bloginfo( 'description', 'display' );
      if ( $invwp_description || is_customize_preview() ) :
        ?>
        <p class="site-description"><?php echo $invwp_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
      <?php endif; ?>
    </div><!-- .site-branding -->

  </div>
</section>

<section class="full-width">
  <div class="container">

    <nav id="site-navigation" class="navbar main-navigation">

      <div class="nav-menu-container">
        <?php
        wp_nav_menu( array(
            'menu_class'     => 'nav-menu',
            'depth'          => 2,
            'container'      => 'div',
            'container_class' => '',
        ) );
        ?>

        <ul class="nav-menu">
          <li class="nav-item">
            <?php if ( class_exists( 'WooCommerce' ) ) { ?>
              <a class="btn-bag" id="btn-bag" style="cursor:pointer;">
                <span class="bag">Bag</span>
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
                <a class="login-modal" id="login-modal" style="cursor:pointer;" href="#">LOGIN</a>
              <?php } ?>
            </div>
          </li>
        </ul>

      </div>

      <div class="menu-toggler" id="menu-toggler">
        <a href="#" class="toggle-icon" id="menu-toggler" onclick="toggle_menu ()">&#9776;</a>
      </div>

    </nav><!-- #site-navigation -->

  </div>
</section>
