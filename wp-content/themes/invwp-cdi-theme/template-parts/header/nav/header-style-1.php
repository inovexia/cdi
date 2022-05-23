<section class="main-nav full-width">
    <div class="container">
        <nav id="site-navigation" class="main-navigation navbar">
            <div class="site-branding">
                <?php
                    // Display the Custom Logo
                    the_custom_logo();
                    if (!has_custom_logo()) {
                        ?>
                <h1><?php bloginfo('name'); ?></h1>
                <?php
                    }
                    ?>
            </div><!-- .site-branding -->
            <div class="small-device-icons">
                <ul>
                    <li>
                        <div class="mobile-search-box">
                            <?php get_search_form(); ?>
                            <div class="mobile-search-icon">
                                <img src="<?php echo get_template_directory_uri () . '/assets/images/search.png'; ?>"
                                    alt="search icon" />
                            </div>
                        </div>
                    </li>
                    <li>
                        <a class="mobile-bag-icon" href="<?php echo site_url(); ?>/cart/">
                            <img src="<?php echo get_template_directory_uri () . '/assets/images/shop.png'; ?>"
                                alt="bag icon" />
                            <?php
                            global $woocommerce;
                            $item_count =  $woocommerce->cart->cart_contents_count;
                            if ($item_count > 9) {
                              $cart_items_count = '9+';
                            } else {
                              $cart_items_count = $item_count;
                            }
                            ?>
                            <span class="mobile-cart-items-count"><?php echo $cart_items_count; ?></span>
                        </a>
                    </li>
                </ul>
                <div class="menu-toggler" id="menu-toggler">
                    <img src="<?php echo get_template_directory_uri () . '/assets/images/menu.png'; ?>" alt="user-icon">
                </div>
            </div>
            <div class="nav-menu-container">
                <div class="menu-main-menu-container">
                    <?php 
                   wp_nav_menu( array( 'theme_location' => 'header', 'menu' => 'Main Menu') );
                   ?>
                    <div class="wc-nav-icon">
                        <?php if (is_user_logged_in()) { ?>
                        <a href="<?php echo site_url(); ?>/my-account">Account</a>
                        <?php } else { ?>
                        <!-- inser more links here -->

                        <a class="" data-target="login-modal" data-toggle="modal" style="cursor:pointer;"
                            data-signin="login">SIGN IN</a>

                        <?php } ?>
                        <a class="mobile-bag-icon" href="<?php echo site_url(); ?>/cart/">
                            <img src="<?php echo get_template_directory_uri () . '/assets/images/shop.png'; ?>"
                                alt="bag icon" />
                            <?php
                            global $woocommerce;
                            $item_count =  $woocommerce->cart->cart_contents_count;
                            if ($item_count > 9) {
                              $cart_items_count = '9+';
                            } else {
                              $cart_items_count = $item_count;
                            }
                            ?>
                            <span class="mobile-cart-items-count"><?php echo $cart_items_count; ?></span>
                        </a>
                    </div>
                </div>
                <ul class="nav-menu-right d-none">
                    <li class="nav-item">
                        <span id="product-search-icon"><img
                                src="<?php echo get_template_directory_uri () . '/assets/images/search-icon.png'; ?>"
                                alt="search icon" /></span>
                    </li>
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
    <div class="mob-mega-menu">
        <div class="mob-menu-body">
            <div class="mob-menu-header">
                <?php
                    // Display the Custom Logo
                    the_custom_logo();
                    if (!has_custom_logo()) {
                        ?>
                <h1><?php bloginfo('name'); ?></h1>
                <?php
                    }
                    ?>
                <span class="close-btn"><i class="fa fa-times" aria-hidden="true"></i>
                </span>
            </div>
            <ul>
                <li>
                    <?php if (is_user_logged_in()) { ?>
                    <a href="<?php echo site_url(); ?>/my-account"><img
                            src="<?php echo get_template_directory_uri () . '/assets/images/user.png'; ?>"
                            alt="user icon" />Account</a>
                    <?php } else { ?>
                    <!-- inser more links here -->

                    <a class="" data-target="login-modal" data-toggle="modal" style="cursor:pointer;"
                        data-signin="login"><img
                            src="<?php echo get_template_directory_uri () . '/assets/images/user.png'; ?>"
                            alt="user icon" />Sign In</a>

                    <?php } ?>
                </li>
                <li><a class="mobile-bag-icon" href="<?php echo site_url(); ?>/cart/">
                        <img src="<?php echo get_template_directory_uri () . '/assets/images/shop.png'; ?>"
                            alt="bag icon" />
                        Shopping Cart
                        <?php
                            global $woocommerce;
                            $item_count =  $woocommerce->cart->cart_contents_count;
                            if ($item_count > 9) {
                              $cart_items_count = '9+';
                            } else {
                              $cart_items_count = $item_count;
                            }
                            ?>
                        <span class="mobile-cart-items-count"><?php echo $cart_items_count; ?></span>
                    </a></li>
            </ul>
            <?php 
                   wp_nav_menu( array( 'theme_location' => 'header', 'menu' => 'Main Menu') );
                   ?>
        </div>
        <div class="mob-menu-footer">
            <ul>
                <li>Call:<a href="tel:1-844-560-7790">
                        1-844-560-7790
                    </a></li>
                <li>Email:<a href="mailto:service@canadianinsulin.com">
                        service@canadianinsulin.com</a></li>
            </ul>
        </div>
    </div>
</section>

<div id="desktopSearch" class="modal search-model">
    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <?php get_search_form(); ?>
    </div>

</div>