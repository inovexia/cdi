<section class="main-nav full-width">
    <div class="container">
        <nav id="site-navigation" class="main-navigation navbar">
            <div class="menu-toggler" id="menu-toggler">
                <img src="<?php echo get_template_directory_uri () . '/assets/images/menu.png'; ?>" alt="user-icon">
            </div>
            <div class="site-branding">
              <?php if( has_custom_logo() ):  ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
                   rel="home">
                   <?php the_custom_logo(); ?>
                </a>
              <?php else: ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="site-title"><?php bloginfo( 'name' ); ?></a>
              <?php endif; ?>
            </div><!-- .site-branding -->

            <div class="nav-menu-container">
                <?php
                wp_nav_menu( array(
                    'menu_class'     => 'nav-menu',
                    'depth'          => 1,
                ) );
                ?>
                <ul class="nav-menu-right">
                    <?php if (is_user_logged_in()) { ?>
                      <li class="nav-item">
                        <div class="dropdown">
                            <a href="#" class="dropbtn">My Account</a>
                            <ul class="dropdown-content">
                                <?php if ( class_exists( 'WooCommerce' ) ) { ?>
                                <li><a class="dropdown-item"
                                        href="<?php echo wc_get_account_endpoint_url(''); ?>">Account Information</a>
                                </li>
                                <li><a class="dropdown-item"
                                        href="<?php echo wc_get_account_endpoint_url('orders'); ?>">My Orders</a></li>
                                <li><a class="dropdown-item"
                                        href="<?php echo wc_get_account_endpoint_url('edit-address'); ?>">Address
                                        Book</a></li>
                                <li><a class="dropdown-item"
                                        href="<?php echo wc_get_account_endpoint_url('payment-methods'); ?>">Payment
                                        Methods</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <?php } ?>
                                <li><a class="dropdown-item" href="<?php echo wp_logout_url(home_url()); ?>"> Logout</a>
                                </li>
                            </ul>
                        </div>
                      </li>
                    <?php } else { ?>
                    <!-- inser more links here -->
                    <li class="nav-item">
                        <a class="" data-target="login-modal" data-toggle="modal" style="cursor:pointer;"
                            data-signin="login">SIGN IN</a>
                    </li>
                    <?php } ?>

                    <?php
            					if ( function_exists( 'invwp_woocommerce_header_cart' ) ) {
            						invwp_woocommerce_header_cart();
            					}
            				?>
                </ul>
            </div>
        </nav><!-- #site-navigation -->
    </div>
</section>
