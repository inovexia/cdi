<?php
/**
* Template Name: How To Order
*
* @package WordPress
* @subpackage Inovexia_Ecomm_Theme
* @since 2021
*/

get_header();
?>
<main id="primary" class="site-main">


<div class="content">

    <!-- Hero section -->
    <?php get_template_part( 'template-parts/page/how-to-order/hero-banner', 'hero'); ?>

    <!-- Order Online section -->
    <?php get_template_part( 'template-parts/page/how-to-order/order-online', 'online'); ?>

    <!-- Order By phone section -->
    <?php get_template_part( 'template-parts/page/how-to-order/order-by-phone', 'phone'); ?>

    <!-- Order By Fax section -->
    <?php get_template_part( 'template-parts/page/how-to-order/order-by-fax', 'fax'); ?>

  </div>


</main><!-- #main -->
<?php get_footer(); ?>
