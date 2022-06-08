<section class="footer-wrp">
    <div class="container">
        <div class="row">
            <div class="col-4">
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
                <div class="footer-payment">
                    <span class="payment-title-mobile">Payment Methods:</span>
                    <div class="payment-options">
                        <?php dynamic_sidebar('bottom-footer-right'); ?>
                    </div>
                    </div>
            </div>
            <div class="col-4">
                <div class="top-footer-menu">
                    <?php dynamic_sidebar('top-footer-menu'); ?>
                </div>
            </div>
            <div class="col-4">
                <div class="top-footer-contact">
                    <?php dynamic_sidebar('top-footer-contact'); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <p>Copyright © 2022 Canadian INSULIN. All rights reserved.</p>
            </div>
            <div class="col-4">
                <div class="social-icons">
                    <?php dynamic_sidebar('bottom-footer-left'); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="top-footer-about">
                    <?php dynamic_sidebar('top-footer-about'); ?>
                </div>
            </div>
        </div>
    </div>
</section>