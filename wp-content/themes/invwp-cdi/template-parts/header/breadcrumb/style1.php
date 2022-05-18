<?php if (is_shop()) {
    $upload_dir = wp_upload_dir(); ?>
  <section class="woocommerce-products-header clearfix mb-5" style="padding: 35px 0 35px 0;background-image:url('<?php echo $upload_dir['baseurl']; ?>/2022/04/shop_banner-1-1.png');background-position: top center; background-repeat: no-repeat; background-size: cover;">
  <?php } else { ?>
  <section class="woocommerce-products-header clearfix breadcrumb-display-none my-5">
  <?php } ?>
    <div class="container">
      <?php
      /**
       * Hook: woocommerce_before_main_content.
       *
       * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
       * @hooked woocommerce_breadcrumb - 20
       * @hooked WC_Structured_Data::generate_website_data() - 30
       */
      $args = array(
        'delimiter' => ' > ',
        'before' => ''
      );
      if (! is_front_page()) { ?>
                  <?php
                  $args = array(
                    'delimiter' => ' > ',
                    'before' => ''
                  );
                  woocommerce_breadcrumb($args);
                  ?>
                  <h1 class="woocommerce-products-header__title page-title "><?php echo $title; ?></h1>
              <?php } ?>
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
        $title = 'Privacy Policy';
        //$sub_title = 'Learn about ' . ucwords(strtolower(get_bloginfo('name'))) . '\'s privacy policy.';
      } else if (is_page('site-map')) {
        $title = 'SITEMAP';
        $sub_title = ucwords(strtolower(get_bloginfo('name'))) . '\'s sitemap.';
      } else if (is_page('magenta-club')) {
        $title = 'Magenta Club';
        $sub_title = '';
      } else if (is_page('faq')) {
        $title = '';
        $sub_title = '';
      } else if (is_page('contact')) {
        $title = '';
        $sub_title = '';
      } else if (is_page('how-to-order')) {
        $title = 'How To Order';
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
      } else {
        $title = '';
        $sub_title = '';
      }
      ?>
      <h1 class="woocommerce-products-header__title page-title"><?php echo $title; ?></h1>
      <p class="woocommerce-breadcrumb-desc"><?php echo $sub_title; ?></p>
      <?php
      /**
       * Hook: woocommerce_archive_description.
       *
       * @hooked woocommerce_taxonomy_archive_description - 10
       * @hooked woocommerce_product_archive_description - 10
       */
      do_action('woocommerce_archive_description');
      ?>
    </div>
  </section>
  
  
  
  