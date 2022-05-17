<?php
/**
* Template Name: Faq
*
* @package WordPress
* @subpackage Inovexia_Ecomm_Theme
* @since 2021
*/

get_header ();
?>

<main id="primary" class="site-main">

    <?php
    /*$sidebar = get_field('sidebar', 'option');

      if($sidebar == 1 || $sidebar == 3){
        get_sidebar('left');
      }*/
    ?>

      <div class="content">

        <!-- Content Area FAQ Section -->
        <?php get_template_part( 'template-parts/page/faq/faq-section', 'faq-page'); ?>

      </div>

    <?php
          /*if($sidebar == 2 || $sidebar == 3){
            get_sidebar('right');
          }*/
    ?>

</main><!-- #main -->
<?php
get_footer ();
?>
