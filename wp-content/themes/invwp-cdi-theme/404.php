<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Inovexia_WP_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">
		<div class="container">

			<section class="error-404 not-found section-margin">
				<header class="page-header text-center col-6 mx-auto">
					<h1 class="page-title"><?php esc_html_e( 'The Page Can Not Be Found.', 'invwp' ); ?></h1>	
					<p>It looks like nothing was found at this location. Maybe try browsing our products.</p>
					<a href="<?php echo site_url('/shop');?>" class="main-btn">Browse Our Products</a>

				</header><!-- .page-header -->

				<!-- <div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'invwp' ); ?></p>

						<?php
						get_search_form();

						the_widget( 'WP_Widget_Recent_Posts' );
						?>

						<div class="widget widget_categories">
							<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'invwp' ); ?></h2>
							<ul>
								<?php
								wp_list_categories(
									array(
										'orderby'    => 'count',
										'order'      => 'DESC',
										'show_count' => 1,
										'title_li'   => '',
										'number'     => 10,
									)
								);
								?>
							</ul>
						</div>

						<?php
						
						$invwp_archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'invwp' ), convert_smilies( ':)' ) ) . '</p>';
						the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$invwp_archive_content" );

						the_widget( 'WP_Widget_Tag_Cloud' );
						?>

				</div> -->
				<!-- .page-content -->
			</section><!-- .error-404 -->
		</div>

	</main><!-- #main -->

<?php
get_footer();
