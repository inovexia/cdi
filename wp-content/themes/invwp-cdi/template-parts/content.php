<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Inovexia_WP_Theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
        <div class="entry-meta">
            <?php
				invwp_posted_on();
				invwp_posted_by();
				?>
        </div><!-- .entry-meta -->
        <?php endif; ?>
    </header><!-- .entry-header -->

    <?php invwp_post_thumbnail(); ?>

    <div class="entry-content display-none">
        <?php
		 the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'invwp' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'invwp' ),
				'after'  => '</div>',
			)
		);
	
		


  
?>


    </div><!-- .entry-content -->
    <div class="blog-content">
        <h3>
            <a href="<?php echo the_permalink(); ?>">
                <?php 
					$title =  get_the_title(); 
					if(strlen($title) > 50){
						echo substr($title,0,50) . " ...";
					}
					else{
						echo $title;
					}
				?>
            </a>
        </h3>
        <?php 
$content = get_the_content();
if(strlen($content) > 200){
	echo substr($content,0,200) . " ...";
}
else{
	echo $content;
}
?>
        <a class="read-more-btn" href="<?php echo the_permalink(); ?>">Read More</a>
    </div>

    <footer class="entry-footer">
        <?php invwp_entry_footer(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->