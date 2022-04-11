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
                <nav class="">
            			<ul class="">
            				<!-- inser more links here -->
            				<li><a class="login-modal" href="#0" style="cursor:pointer;" data-signin="login">LOG IN</a></li>
            			</ul>
            		</nav>
              <?php } ?>
            </div>
          </li>
          <li class="nav-item">
            <a href="#">NEW USER? SIGN UP</a>
          </li>
          
        </ul>

      </div>

      <div class="search-section-nav">
        <form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <div>
                <label class="screen-reader-text" for="s"><?php _x( 'Search for:', 'label' ); ?></label>
                <i class="fas fa-search" aria-hidden="true"></i>
                <input type="text" Placeholder="Search" value="<?php echo get_search_query(); ?>" name="s" id="s" />
            </div>
        </form>
      </div>

      <div class="bag-section">
        <?php if ( class_exists( 'WooCommerce' ) ) { ?>
          <a class="btn-bag" id="btn-bag" style="cursor:pointer;">
            <span class="bag"><i class="fas fa-shopping-bag" aria-hidden="true"></i></span>
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
      </div>

      <div class="menu-toggler" id="menu-toggler">
        <a href="#" class="toggle-icon" id="menu-toggler" onclick="toggle_menu ()">&#9776;</a>
      </div>

    </nav><!-- #site-navigation -->
  </div>
</section>
