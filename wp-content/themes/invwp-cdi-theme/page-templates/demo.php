<?php
/**
* Template Name: Demo
*
* @package WordPress
* @subpackage Inovexia_Ecomm_Theme
* @since 2021
*/

get_header ();
?>

<main id="primary" class="site-main">

  <div class="content">
    <!-- Hero section -->
    <?php get_template_part( 'template-parts/component/two-column/left-column-image'); ?>
    <?php get_template_part( 'template-parts/component/three-column/three-column-divided-img-text'); ?>
    <?php get_template_part( 'template-parts/component/slider/two-column-slider'); ?>
    <?php get_template_part( 'template-parts/component/slider/three-column-slider'); ?>
    <?php get_template_part( 'template-parts/component/slider/one-column-slider'); ?>
    <?php get_template_part( 'template-parts/component/contact-form/two-column-form'); ?>
    <?php get_template_part( 'template-parts/component/accordion/plus-minus-icon'); ?>
  </div>

</main><!-- #main -->


<?php
get_footer ();
?>