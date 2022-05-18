<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Inovexia_WP_Theme
 */

if ( ! is_active_sidebar( 'sidebar-right' ) ) {
	return;
}
?>

<aside class="sidebar-right widget-area">
	<?php dynamic_sidebar( 'sidebar-right' ); ?>
</aside>
