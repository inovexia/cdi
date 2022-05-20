<?php
/* Template Name: All Article Blogs */

get_header();
?>

<div id="primary" class="site-content blog-page">
  <div class="container">

		  <div class="row post-maincolumns px-0">	
        <div class="col-3">
          <?php get_sidebar('shop'); ?>
        </div>	

    		<div class="col-9 my-5">
					<h2 class="section-title text-left">All Articles</h2>	
						<div class="row post-maincolumns">
						  <?php
							$args = array(
								'post_type' => 'post',
								'post_status' => 'publish',
    						//'category_name' => '',
								'posts_per_page' => -1,
								'order' => 'ASC',
								//'paged' => get_query_var('paged'),
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
								  <!--<p class="card-text mb-5 mt-5">
									<?php
										$excerpt= get_the_excerpt();
										echo substr($excerpt, 0, 160);
										//echo get_the_excerpt();
									 ?>
								  </p>-->
								  <a href="<?php echo the_permalink(); ?>" class="read-more text-right">Read More</a>
								</div>
							  </div>
							</div>
							<?php
				  				  }
								wp_reset_postdata();
									}
  						?>
    			</div><!-- #end row inner -->
    		</div>
    	</div><!-- #end row main -->

  </div><!-- #content -->
</div><!-- #primary -->

<?php get_footer(); ?>