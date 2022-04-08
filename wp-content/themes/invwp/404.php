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

<div class="container">

	<main id="primary" class="site-main">

			<div class="content">

				<section class="error-404 not-found text-center">
					<header class="page-header">
						<h2 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'invwp' ); ?></h2>
					</header><!-- .page-header -->

					<div class="page-content">
						<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'invwp' ); ?></p>

					</div><!-- .page-content -->
				</section><!-- .error-404 -->

			</div>

		</main><!-- #main -->

</div>

<?php
get_footer();
