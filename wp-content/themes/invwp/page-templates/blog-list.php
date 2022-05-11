<?php
/* Template Name: Article Blogs */

get_header();
?>

<div id="primary" class="site-content blog-page">
  <div class="container">
    <?php
  	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  	// are we on page one?
  	if (1 == $paged) {

    			$args = array(
    				'post_type' => 'post',
    				'post_status' => 'publish',
    				'posts_per_page' => 1,
    				'order' => 'ASC',
    			);
    			$post_query = new WP_Query($args);

    			if($post_query->have_posts() ) {
      			while($post_query->have_posts() ) {

      				$post_query->the_post();
          		?>
			  <div class="row px-0">
				<div class="col-12 blog-big-image">
				  <?php
					if ( has_post_thumbnail() ) :
					  the_post_thumbnail();
					endif;
				  ?>
				</div>
				<div class="col-12 text-center my-5">
					<h2 class="section-title"><?php echo the_title(); ?></h2>
					<p class="section-description">
					  <?php
						$excerpt= get_the_excerpt();
						echo substr($excerpt, 0, 200);
						//echo get_the_excerpt();
					   ?>
					</p>
				</div>
			  </div>

			<?php
				}
				wp_reset_postdata();
				}
    		?>

    <div class="row post-maincolumns">
		  <?php
			$args = array(
				'post_type' => 'post',
				'post_status' => 'publish',
				'posts_per_page' => 3,
				'order' => 'ASC',
				'paged' => get_query_var('paged'),
			);

			$post_query = new WP_Query($args);

			if ($post_query->have_posts() ) {

				while($post_query->have_posts() ) {

					$post_query->the_post();
		  ?>
		  <div id="post-<?php the_ID(); ?>" class="col-4 blog-column px-5">

			  <div class="row">
				<div class="col-12">
				  <?php
						if ( has_post_thumbnail() ) :
							the_post_thumbnail();
						endif;
					?>
				</div>
				<div class="col-12 px-6 my-5 text-left">
				  <h4 class="my-5"><?php echo the_title(); ?></h4>
				  <div class="post-meta my-4"><?php the_time( 'F j, Y' ); ?></div>
				  <p class="card-text mb-5 mt-5">
					<?php
						$excerpt= get_the_excerpt();
						echo substr($excerpt, 0, 160);
						//echo get_the_excerpt();
					 ?>
				  </p>
				  <a href="<?php echo the_permalink(); ?>" class="read-more text-right">Read More</a>
				</div>
			  </div>
			</div>

			<?php
  				  }
				wp_reset_postdata();
  			?>
		  <div class="clearfix"></div>
		  <div class="col-12">
			<nav aria-label="Page navigation example">
			<ul class="pagination d-flex justify-content-center">
			  <li class="page-item">
				<?php
					$big = 999999999;
					echo paginate_links( array(
						  'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
						  'format' => '?paged=%#%',
						  'current' => max( 1, get_query_var('paged') ),
						  'total' => $post_query->max_num_pages,
						  'prev_text' => 'PREVIOUS',
						  'next_text' => 'NEXT'
					) );

					}
				?>
			  </li>
			</ul>
		  </nav>
		</div>
	
    </div>
    <?php } else { ?>
    <div class="row row-main-blogs">

      <?php
		$args = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => 3,
			'order' => 'ASC',
			'paged' => get_query_var('paged'),
		);

		$post_query = new WP_Query($args);

	if($post_query->have_posts() ) {

		while($post_query->have_posts() ) {

			$post_query->the_post();
		?>

	   <div id="post-<?php the_ID(); ?>" class="col-4 blog-column px-5">

		<div class="row">
		  <div class="col-12">
			<?php
				if ( has_post_thumbnail() ) :
					the_post_thumbnail();
				endif;
			?>
		  </div>
		  <div class="col-12 px-6 my-5 text-left">
			  <h4 class="my-5"><?php echo the_title(); ?></h4>
			  <div class="post-meta my-4"><?php the_time( 'F j, Y' ); ?></div>
			  <p class="card-text mb-5 mt-5">
				<?php
					$excerpt= get_the_excerpt();
					echo substr($excerpt, 0, 160);
					//echo get_the_excerpt();
				 ?>
			  </p>
			  <a href="<?php echo the_permalink(); ?>" class="read-more text-right">Read More</a>
		  </div>
		</div>
	  </div>

      <?php
						}
    wp_reset_postdata();
						?>
      <div class="clearfix"></div>
      <div class="col-12">
		  <nav aria-label="Page navigation example">
			  <ul class="pagination d-flex justify-content-center">
				<li class="page-item">
					<?php
						$big = 999999999;
						echo paginate_links( array(
							  'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
							  'format' => '?paged=%#%',
							  'current' => max( 1, get_query_var('paged') ),
							  'total' => $post_query->max_num_pages,
							  'prev_text' => 'PREVIOUS',
							  'next_text' => 'NEXT'
						) );
					}
				?>
				</li>
			  </ul>
		  </nav>
      </div>
    </div>
    <?php } ?>
  </div><!-- #content -->
</div><!-- #primary -->

<?php get_footer(); ?>
