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



  <div class="content">
    <!--Contact Section-->
    <?php get_template_part( 'template-parts/component/contact-form/contact-form-all'); ?>
    <!--Contact Newsletter Section-->
    <?php get_template_part( 'template-parts/page/contact-us/contact-newsletter'); ?>

  </div>


</main><!-- #main -->
<?php
get_footer ();
?>