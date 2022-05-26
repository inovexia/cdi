<section class="woocommerce-products-header clearfix ">
    <div class="container">
        <div class="wc-container" <?php if(is_shop() || is_product_category()){?>
            style="background-image:url('<?php echo get_template_directory_uri () . '/assets/images/shop-banner.png'; ?>')"
            <?php } ?>>
            <?php
    if (is_shop()) {
      $title = 'BROWSE MEDICATION';
      $sub_title = 'Check out our wide range of fillers and injectables.';
    } else if ( is_product()) {
      $title = '';
      $sub_title = '';
    } else if (is_page('blog')) {
      $title = 'BEAUTY INDUSTRY';
      $sub_title = 'Read the latest news about the beauty business.';
    } else if (is_page('privacy-policy')) {
      $title = 'PRIVACY POLICY';
      $sub_title = 'Learn about ' . ucwords(strtolower(get_bloginfo('name'))) . '\'s privacy policy.';
    } else if (is_page('site-map')) {
      $title = 'SITEMAP';
      $sub_title = ucwords(strtolower(get_bloginfo('name'))) . '\'s sitemap.';
    } else if (is_page('faq')) {
      $title = 'FAQ';
      $sub_title = '';
    } else if (is_page('contact')) {
      $title = 'Contact Information';
      $sub_title = 'Contact us by phone or email any time if you require assistance.
      We’re here for you.';
    } else if (is_page('shipping-returns')) {
      $title = 'REFUND AND RETURNS POLICY';
      $sub_title = '';
    } else if (is_page('about-us')) {
      $title = 'About Us';
      $sub_title = 'We provide low cost insulin to American diabetics safely and secure';
    } else if (is_page('referral')) {
      $title = '';
      $sub_title = '';
    } else if (is_404()) {
      $title = 'PAGE NOT FOUND';
      $sub_title = '';
    } else if (is_search()) {
      $title = '';
      $sub_title = '';
    } else if (is_page('checkout')) {
      $title = '';
      $sub_title = '';
    } else if (is_page('how-to-order')) {
      $title = 'How To Order';
      $sub_title = '';
    } else {
      $title = get_the_title();
      $sub_title = 'Edit your personal information.';
    }
    ?>
            <div class="woocommerce-products-header">
                <?php /*if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
                <h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
                <?php
  			/**
  			 * Hook: woocommerce_archive_description.
  			 *
  			 * @hooked woocommerce_taxonomy_archive_description - 10
  			 * @hooked woocommerce_product_archive_description - 10
  			 * /
  			do_action( 'woocommerce_archive_description' );
  			?>
                <?php else: */?>
                <?php if (! is_front_page()) { ?>
                <?php
  				$args = array(
  				  'delimiter' => ' > ',
  				  'before' => ''
  				);
  				woocommerce_breadcrumb($args);
  				?>
                <h1 class="woocommerce-products-header__title page-title "><?php echo $title; ?></h1>
                <?php if($sub_title !== ""){ ?>
                <p class="subtitle"><?php echo $sub_title; ?></p>

                <?php }
         else{
           echo "";
         } ?>
                <?php } ?>
                <?php /*endif; */?>
            </div>
        </div>

    </div>
</section>