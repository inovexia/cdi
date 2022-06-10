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

<footer id="colophon" class="site-footer"
    style="background-image:url('<?php echo get_template_directory_uri(); ?>/assets/images/footerBg.jpg');">
    <!-- Footer Loader File -->
    <?php get_template_part('template-parts/footer/footer'); ?>

</footer><!-- #colophon -->

</div><!-- #page -->

<!-- Include login-registration modal template -->
<?php get_template_part('template-parts/component/all-modal/auth-modal', ''); ?>

<?php get_template_part('template-parts/component/all-modal/mini-cart'); ?>

<?php wp_footer(); ?>

</body>

</html>