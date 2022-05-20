<?php
/**
* Template Name: Get Started
*
* @package WordPress
* @subpackage Inovexia_Ecomm_Theme
* @since 2021
*/

get_header();
?>
<main id="primary" class="site-main">

    <?php //get_sidebar('left'); ?>

      <div class="content">

        <!-- Hero Section -->
        <?php get_template_part( 'template-parts/page/get-started/banner'); ?>

        <!-- Content Area Get Started Section -->
        <?php get_template_part( 'template-parts/page/get-started/content-section'); ?>
		  
      </div>

    <?php //get_sidebar('right'); ?>

</main><!-- #main -->
<?php get_footer(); ?>
