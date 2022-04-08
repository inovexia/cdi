<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Inovexia_WP_Theme
 */

get_header();
?>

<div class="container">

	<main id="primary" class="site-main">

		<?php
		$sidebar = get_field('sidebar', 'option');

			if($sidebar == 1 || $sidebar == 3){
				get_sidebar('left');
			}
		?>

			<div class="content">

				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content', get_post_type() );

					the_post_navigation(
						array(
							'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'invwp' ) . '</span> <span class="nav-title">%title</span>',
							'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'invwp' ) . '</span> <span class="nav-title">%title</span>',
						)
					);

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>
			</div>

			<?php
						if($sidebar == 2 || $sidebar == 3){
							get_sidebar('right');
						}
			?>

	</main><!-- #main -->

</div><!-- .container -->

<?php
get_footer();
