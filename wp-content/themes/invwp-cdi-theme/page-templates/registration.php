<?php
   /**
   * Template Name: Registration
   *
   * @package WordPress
   * @subpackage Inovexia_Ecomm_Theme
   * @since 2021
   */

   get_header();
   ?>
<main id="primary" class="site-main">
   <div class="content">
      <section class="registration-section section-margin section-padding">
         <div class="container">
            <?php wc_get_template ('myaccount/checkout-registration-form.php'); ?>
         </div>
       </section>
   </div>
</main>
<!-- #main -->
<?php get_footer(); ?>
