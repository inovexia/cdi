<section class="main-nav full-width">
  <div class="container">
    <nav id="site-navigation" class="navbar ">

      <div class="site-branding header-logo">
        <?php if( has_custom_logo() ):  ?>
          <?php
            // Get Custom Logo URL
            $custom_logo_id = get_theme_mod( 'custom_logo' );
            $custom_logo_data = wp_get_attachment_image_src( $custom_logo_id , 'full' );
            $custom_logo_url = $custom_logo_data[0];
          ?>
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
             rel="home">
              <img src="<?php echo esc_url( $custom_logo_url ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"/>
          </a>
        <?php //the_custom_logo(); ?>
        <?php else: ?>
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="site-title"><?php bloginfo( 'name' ); ?></a>
        <?php endif;
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
            <div class="dropdown">
              <?php if (is_user_logged_in()) { ?>
                <!--<a href="#" class="dropbtn">My Account</a>
                <ul class="dropdown-content">
                  <?php if ( class_exists( 'WooCommerce' ) ) { ?>
                    <li><a class="dropdown-item" href="<?php echo wc_get_account_endpoint_url(''); ?>">Account Information</a></li>
                    <li><a class="dropdown-item" href="<?php echo wc_get_account_endpoint_url('orders'); ?>">My Orders</a></li>
                    <li><a class="dropdown-item" href="<?php echo wc_get_account_endpoint_url('edit-address'); ?>">Address Book</a></li>
                    <li><a class="dropdown-item" href="<?php echo wc_get_account_endpoint_url('payment-methods'); ?>">Payment Methods</a></li>
                    <li><hr class="dropdown-divider"></li>
                  <?php } ?>
                  <li><a class="dropdown-item" href="<?php echo wp_logout_url(home_url()); ?>"> Logout</a></li>
                </ul>-->
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

        </ul>

      </div>

      <div class="menu-toggler" id="menu-toggler">
        <a href="#" class="toggle-icon" id="menu-toggler" onclick="toggle_menu ()">&#9776;</a>
      </div>

    </nav><!-- #site-navigation -->
  </div>
</section>
