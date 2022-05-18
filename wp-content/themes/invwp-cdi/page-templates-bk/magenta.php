<?php
/**
* Template Name: Magenta
*
* @package WordPress
* @subpackage INV_WPinvwpsTARTER
* @since 2021
*/

get_header();
?>
<!-- Hero single image -->
<?php get_template_part( 'template-parts/page/magenta-club/banner', ''); ?>

<!-- Content Area Section -->
<?php get_template_part( 'template-parts/page/magenta-club/content-section', ''); ?>

<!-- FAQ Section -->
<?php get_template_part( 'template-parts/component/accordion/up-down-icon', ''); ?>

<?php
get_footer ();
?>
