<section class="woocommerce-products-header clearfix ">
<div class="wc-container image-breadcrumb" <?php if (is_shop() || is_product_category()) { ?> style="background-image:url('<?php echo get_template_directory_uri () . '/assets/images/shop-banner.png'; ?>')" <?php } ?>>
    <div class="container">
      <?php
      if (is_shop()) {
        $title = 'BROWSE MEDICATION';
        $sub_title = 'Check out our wide range of fillers and injectables.';
      } else {
        $title = the_title('', '', false);
        $sub_title = '';
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
          <?php
          if (! is_front_page()) {
    				$args = array(
    				  'delimiter' => ' > ',
    				  'before' => ''
    				);
    				woocommerce_breadcrumb($args);
    				?>
            <h1 class="woocommerce-products-header__title page-title "><?php echo $title; ?></h1>
            <?php if ($sub_title !== "") { ?>
              <p class="subtitle"><?php echo $sub_title; ?></p>
            <?php }
          }
          ?>
      </div>
    </div>
  </div>
</section>
