<section class="main-nav full-width">
    <div class="container">
        <nav id="site-navigation" class="main-navigation navbar">
            <div class="site-branding">
                <?php if( has_custom_logo() ):  ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
                    title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" rel="home">
                    <?php the_custom_logo(); ?>
                </a>
                <?php else: ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"
                    class="site-title"><?php bloginfo( 'name' ); ?></a>
                <?php endif; ?>
            </div><!-- .site-branding -->

            <div class="nav-menu-container">
                <?php
                wp_nav_menu( array(
                    'menu_class'     => 'nav-menu',
                    'depth'          => 1,
                ) );
                ?>
            </div>
            <div class="header-right">
                <ul class="nav-menu-right">
                    <li class="mob-search">
                        <?php get_search_form(); ?>
                        <img src="<?php echo get_template_directory_uri () . '/assets/images/search.png'; ?>"
                            alt="search-icon" />
                    </li>
                    <?php if (is_user_logged_in()) { ?>
                    <li class="nav-item account-btn">
                        <div class="dropdown">
                            <a href="#" class="dropbtn"><img
                                    src="<?php echo get_template_directory_uri () . '/assets/images/account.png'; ?>"
                                    alt="user-icon"></a>
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
                    <li class="nav-item sign-in-btn">
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
                <div class="menu-toggler" id="menu-toggler">
                    <img src="<?php echo get_template_directory_uri () . '/assets/images/menu.png'; ?>" alt="user-icon">
                </div>
            </div>
        </nav><!-- #site-navigation -->
    </div>
    <div class="mob-mega-menu">
        <div class="mob-menu-header">
            <?php if( has_custom_logo() ):  ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
                title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" rel="home">
                <?php the_custom_logo(); ?>
            </a>
            <?php else: ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"
                class="site-title"><?php bloginfo( 'name' ); ?></a>
            <?php endif; ?>
            <span class="close-btn"><i class="fa fa-times" aria-hidden="true"></i>
            </span>
        </div>
        <div class="mob-menu-wc-feature">
            <ul>
                <li><img src="<?php echo get_template_directory_uri () . '/assets/images/account.png'; ?>"
                        alt="user-icon" />
                    <?php if (is_user_logged_in()) { ?>
                    <a href="<?php echo site_url(); ?>/my-account">My Account</a>
                    <?php } else { ?>
                    <!-- inser more links here -->
                    <span class="nav-item">
                        <a class="" data-target="login-modal" data-toggle="modal" style="cursor:pointer;"
                            data-signin="login">Sign In</a>
                    </span>
                    <?php } ?>
                </li>
            </ul>
        </div>
        <div class="mob-menu-header">
            <?php
                wp_nav_menu( array(
                    'menu_class'     => 'nav-menu',
                    'depth'          => 1,
                ) );
                ?>
        </div>
        <div class="mob-menu-footer">
            <ul>
                <li>Call:<a href="tel:1-844-560-7790">1-844-560-7790
                    </a></li>
                <li>Email: <a href="mailto:service@canadianinsulin.com">service@canadianinsulin.com</a></li>
            </ul>
        </div>
    </div>
</section>