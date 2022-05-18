<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Inovexia_WP_Theme
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<?php
		$sidebar = get_field('sidebar', 'option');

			if($sidebar == '1'){
				get_theme_file_path('sidebar-left.php');
			}
			elseif($sidebar == 'Right Sidebar'){
				get_theme_file_path('sidebar-left.php');
			}
			elseif($sidebar == 'Both Sidebar'){
				get_theme_file_path('sidebar-left.php');
			}
			else{
				get_theme_file_path('sidebar.php');
			}

		dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
