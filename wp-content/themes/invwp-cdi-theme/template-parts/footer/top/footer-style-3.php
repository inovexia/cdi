<section class="footer-wrp">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="site-branding">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    	<?php dynamic_sidebar('top-footer-logo'); ?>    
					</a>
                </div><!-- .site-branding -->
                <div class="footer-payment">
                    <!-- <span class="payment-title-mobile">Payment Methods:</span> -->
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
        <div class="row bottom-footer-data">
            <div class="col-8 copyright-text">
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