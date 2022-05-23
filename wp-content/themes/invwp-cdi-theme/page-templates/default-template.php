<?php
/**
 * Template Name: Theme Default Template
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Inovexia_Ecomm_Theme
 */

get_header();
?>
<div class="container">
  <?php
  while ( have_posts() ) :
    the_post();

    get_template_part( 'template-parts/content', 'page' );

  endwhile; // End of the loop.
  ?>

</div>
<?php
get_footer ();
?>
