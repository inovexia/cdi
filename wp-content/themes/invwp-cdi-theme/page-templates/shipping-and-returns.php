<?php
/**
* Template Name: Shipping & Returns
*
* @package WordPress
* @subpackage Inovexia_Ecomm_Theme
* @since 2021
*/

get_header ();
?>
<main id="primary" class="site-main">

    <?php get_sidebar('left'); ?>

      <div class="content">

        <section class="section-privacyfullwidth">
          <div class="container body-container">
            <div class="row">
              <div class="col-12 privacy-inner-content">
                <h4 class="lato-normal-black-pearl-14px text-uppercase"><?php echo the_field('shipment_title'); ?></h4>
                <div class="lato-normal-black-pearl-14px">
                  <p><?php echo the_field('shipment_content'); ?></p>
                </div>
              </div>
            </div>
          </div>
        </section>

      </div>

    <?php get_sidebar('right'); ?>

</main><!-- #main -->





<?php get_footer(); ?>
