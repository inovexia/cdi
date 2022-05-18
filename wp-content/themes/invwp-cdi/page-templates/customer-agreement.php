<?php
/**
* Template Name: Customer Agreement
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

        <!-- Content Area Customer Agreement Section -->
        <?php get_template_part( 'template-parts/page/customer-agreement/content-section', 'content'); ?>

      </div>

    <?php //get_sidebar('right'); ?>

</main><!-- #main -->
<?php get_footer(); ?>
