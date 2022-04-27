<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Inovexia_WP_Theme
 */

?>

<!-- Load Footer template -->
<?php get_template_part('template-parts/footer/footer'); ?>

</div><!-- #page -->

<!-- Include login-registration modal template -->
<?php get_template_part('template-parts/component/all-modal/auth-modal', ''); ?>
<?php get_template_part('template-parts/component/offcanvas-sidebar', ''); ?>

<?php wp_footer(); ?>

</body>
</html>
