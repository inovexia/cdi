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

    <div class="content">
        <!-- Hero section -->
        <?php //get_template_part( 'template-parts/page/home/hero-image', 'hero'); ?>

        <!--Products Slider-->
        <?php //get_template_part( 'template-parts/page/home/product-categories'); ?>

        <!--Help Section-->
        <?php //get_template_part( 'template-parts/page/home/about-us'); ?>

        <!--Products Slider-->
        <?php //get_template_part( 'template-parts/page/home/industry-blogs', 'blogs'); ?>

        <!--Contact Section-->
        <?php //get_template_part( 'template-parts/page/home/contact', 'contact'); ?>

      </div>

  	</main><!-- #main -->

  </div>
<?php
get_footer ();
?>
