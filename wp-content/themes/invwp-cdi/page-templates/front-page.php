<?php
/**
* Template Name: Front Page
*
* @package WordPress
* @subpackage Inovexia_WP_Theme
* @since 2021
*/

get_header ();
?>
<main id="primary" class="site-main">

<<<<<<< HEAD
  <div class="content">
    <!-- Hero section -->
=======
    <div class="content">
        <!-- Hero section -->
>>>>>>> 2374b8f6ed51acccb8551f5ee319be14531c8a1f
        <?php get_template_part( 'template-parts/page/home/hero-image', 'hero'); ?>

        <!--Products Slider-->
        <?php get_template_part( 'template-parts/page/home/product-categories'); ?>

        <!--Help Section-->
        <?php get_template_part( 'template-parts/page/home/about-us'); ?>

        <!--Home Shop Section-->
        <?php get_template_part( 'template-parts/page/home/home-shop'); ?>

        <!--Products Slider-->
        <?php get_template_part( 'template-parts/page/home/industry-blogs', 'blogs'); ?>

        <!--Faq Section-->
        <?php get_template_part( 'template-parts/page/home/faq'); ?>

        <!--Testimonial Section-->
        <?php get_template_part( 'template-parts/page/home/testimonial'); ?>
<<<<<<< HEAD
=======

        <!--Contact Section-->
        <?php //get_template_part( 'template-parts/page/home/contact', 'contact'); ?>

      </div>

  	</main><!-- #main -->
>>>>>>> 2374b8f6ed51acccb8551f5ee319be14531c8a1f

  </div>
<?php
get_footer ();
?>
