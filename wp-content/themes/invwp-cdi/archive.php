<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Inovexia_WP_Theme
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php if ( have_posts() ) : ?>

    <header class="page-header">
        <div class="container">
            <?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
					?>
        </div>
    </header><!-- .page-header -->

    <div class="container">
        <div class="blogs-data row">
            <?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
					 * Include the Post-Type-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_type() );

				endwhile;

				the_posts_navigation();
				?>
        </div>

    </div>
    <?php else : ?>
    <div class="container">
        <div class="no-blogs">
            <?php get_template_part( 'template-parts/content', 'none' ); ?>
        </div>


    </div>
    <?php endif; ?>

</main><!-- #main -->

<?php
//get_sidebar();
get_footer();