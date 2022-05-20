<section class="main-nav full-width">
    <div class="container">
        <nav id="site-navigation" class="main-navigation navbar">
            <div class="menu-toggler" id="menu-toggler">
                <img src="<?php echo get_template_directory_uri () . '/assets/images/menu.png'; ?>" alt="user-icon">
            </div>
            <div class="site-branding">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"
                    class="site-title"><?php bloginfo( 'name' ); ?></a>
                <?php
  			//the_custom_logo();
  			/*
  			$invwp_description = get_bloginfo( 'description', 'display' );
  			if ( $invwp_description || is_customize_preview() ) :
  				?>
                <p class="site-description">
                    <?php echo $invwp_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                </p>
                <?php endif;
  			*/
  			?>
            </div><!-- .site-branding -->
            <div class="small-device-icons">
                <ul>
                    <li><?php if (is_user_logged_in()) { ?>
                        <a class="my-account-link" href="<?php echo site_url(); ?>/my-account/">
                            <img src="<?php echo get_template_directory_uri () . '/assets/images/account.png'; ?>"
                                alt="user icon" />
                        </a>
                        <?php } 
                        else{ ?>
                        <a class="my-account-text" data-target="login-modal" data-toggle="modal" style="cursor:pointer;"
                            data-signin="login">SIGN IN</a>
                        <?php } ?>
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
            </div>

            <div class="nav-menu-container">
                <div class="menu-main-menu-container">
                    <ul id="menu-main-menu" class="nav-menu">
                        <li class="menu-item" id="has-submenu">
                            <a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>">PRODUCTS</a>
                            <?php get_template_part('template-parts/header/nav/header', 'mega-menu'); ?>
                        </li>
                        <li class="menu-item"><a href="<?php echo get_permalink( get_page_by_path('about') ); ?>">ABOUT
                                US</a></li>
                        <li class="menu-item"><a
                                href="<?php echo get_permalink( get_page_by_path('industry') ); ?>">INDUSTRY</a></li>
                        <li class="menu-item"><a
                                href="<?php echo get_permalink( get_page_by_path('contact-us') ); ?>">CONTACT</a></li>
                    </ul>
                </div>
                <ul class="nav-menu-right">
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
        <div class="mobile-search-box">
            <?php get_search_form(); ?>
            <div class="mobile-search-icon">
                <img src="<?php echo get_template_directory_uri () . '/assets/images/search.png'; ?>"
                    alt="search icon" />
            </div>
        </div>
    </div>
    <div class="mob-mega-menu">
        <div class="container">
            <div class="cat">
                <h4>Our Products</h4>
                <ul class="cat-menu">
                    <?php
                            $terms =  array(
                              'taxonomy' => 'product_cat', 
                              'hide_empty' => false,
                            );
                            $product_brand = get_terms($terms);
                            foreach ($product_brand as $key => $brand) { ?>
                    <li>
                        <a
                            href="<?php echo get_term_link($brand); ?>"><?php echo $brand->name;  ?><span>(<?php echo $brand->count; ?>)</span></a>
                    </li>
                    <?php }  ?>
                </ul>
                <h4>Accessories</h4>
                <ul class="list-unstyled">
                    <?php
                            $terms =  array(
                              'taxonomy' => 'product_cat', 
                              'hide_empty' => false,
                            );
                            $product_brand = get_terms($terms);
                            foreach ($product_brand as $key => $brand) { ?>
                    <li>
                        <a
                            href="<?php echo get_term_link($brand); ?>"><?php echo $brand->name;  ?><span>(<?php echo $brand->count; ?>)</span></a>
                    </li>
                    <?php }  ?>
                </ul>
                <h4>Nullam</h4>
                <ul class="list-unstyled">
                    <?php
                            $terms =  array(
                              'taxonomy' => 'product_cat', 
                              'hide_empty' => false,
                            );
                            $product_brand = get_terms($terms);
                            foreach ($product_brand as $key => $brand) { ?>
                    <li>
                        <a
                            href="<?php echo get_term_link($brand); ?>"><?php echo $brand->name;  ?><span>(<?php echo $brand->count; ?>)</span></a>
                    </li>
                    <?php }  ?>
                </ul>
                <h4>Etiam</h4>
                <ul class="list-unstyled">
                    <?php
                            $terms =  array(
                              'taxonomy' => 'product_cat', 
                              'hide_empty' => false,
                            );
                            $product_brand = get_terms($terms);
                            foreach ($product_brand as $key => $brand) { ?>
                    <li>
                        <a
                            href="<?php echo get_term_link($brand); ?>"><?php echo $brand->name;  ?><span>(<?php echo $brand->count; ?>)</span></a>
                    </li>
                    <?php }  ?>
                </ul>
            </div>
            <div class="m-menu">
                <h4>Menu</h4>
                <ul>
                    <li>
                        <a href="<?php echo site_url(); ?>/about/">About Us</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url(); ?>/industry/">Industry</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url(); ?>/contact-us/">Contact</a>
                    </li>
                </ul>
            </div>
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