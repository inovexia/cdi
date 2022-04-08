<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Inovexia_WP_Theme
 */

if ( ! is_active_sidebar( 'sidebar-left' ) ) {
	return;
}
?>
<aside class="sidebar-left widget-area">
	<?php dynamic_sidebar( 'sidebar-left' ); ?>
</aside>
