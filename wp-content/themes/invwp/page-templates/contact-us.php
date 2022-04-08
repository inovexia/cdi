<?php
/**
* Template Name: Contact Us
*
* @package WordPress
* @subpackage Inovexia_Ecomm_Theme
* @since 2021
*/

get_header ();
?>
<main id="primary" class="site-main">

    <?php
          if($sidebar == 2 || $sidebar == 3){
            get_sidebar('right');
          }
    ?>

      <div class="content">

        <!-- Hero single image -->
        <?php get_template_part( 'template-parts/page/contact-us/banner', 'contact-page'); ?>

        <!-- Content Area Contact Section -->
        <?php get_template_part( 'template-parts/page/contact-us/contact-section', 'contact-page'); ?>

      </div>

    <?php
          if($sidebar == 2 || $sidebar == 3){
            get_sidebar('right');
          }
    ?>

</main><!-- #main -->
<?php
get_footer ();
?>
