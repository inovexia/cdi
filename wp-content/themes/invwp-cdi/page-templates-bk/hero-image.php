<?php
/**
* Template Name: hero-image
*
* @package WordPress
* @subpackage Inovexia_Ecomm_Theme
* @since 2021
*/


get_header();
?>
<main id="primary" class="site-main">

    <?php
    $sidebar = get_field('sidebar', 'option');

      if($sidebar == 1 || $sidebar == 3){
        get_sidebar('left');
      }
    ?>



<?php get_template_part( 'template-parts/page/hero-image/hero-image1'); ?>
<?php get_template_part( 'template-parts/page/hero-image/hero-image2'); ?>
<?php get_template_part( 'template-parts/page/hero-image/hero-image3'); ?>	



	

</main><!-- #main -->
<?php get_footer(); ?>
 
	