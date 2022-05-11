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
		<div class="row">
		  <div class="col-12">
			<h1 class="section-title"><?php echo the_title(); ?></h1>
			<div class="archive-meta ">
			  <p>Posted On <strong>
				<span><?php the_time( 'F j, Y' ); ?></span></strong> By <strong><?php the_author(); ?></strong></p>
			  </p>
			</div>
		  </div>
		</div>
		<?php
		/*$sidebar = get_field('sidebar', 'option');

			if($sidebar == 1 || $sidebar == 3){
				get_sidebar('left');
			}*/
		?>
      <div class="clearfix"></div>

		<div class="row ">
			<div class="col-12">

			<?php
			while ( have_posts() ) :
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="row">
              <div class="col-6">
                <div class="entry-content"><?php the_content(); ?></div>
              </div>
              <div class="col-6">
                <div class="post-thumbnail text-center blog-big-image">
                  <?php
					  if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
					  the_post_thumbnail( 'post-thumbnail' );
					  }
					  //the_post_thumbnail(array(250, 250)); 
				  ?>
                </div>
              </div>
            </div>
        </div>
        </article>
			<?php
				/*the_post();

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
				endif;*/

			endwhile; // End of the loop.
			?>
			</div>
		</div>

		<?php
			/*if($sidebar == 2 || $sidebar == 3){
				get_sidebar('right');
			}*/
		?>

	</main><!-- #main -->

</div><!-- .container -->

<?php
get_footer();
