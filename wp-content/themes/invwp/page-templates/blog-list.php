<?php
/* Template Name: All Blogs */

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

    <div class="bg-dark">
      <div class="col-12 px-0">
        <div class="col-12 blog-big-image">
          <?php
            if ( has_post_thumbnail() ) :
              the_post_thumbnail();
            endif;
          ?>
        </div>
        <h1 class=""><?php echo the_title(); ?></h1>
        <p class="">
          <?php
            $excerpt= get_the_excerpt();
            echo substr($excerpt, 0, 200);
            //echo get_the_excerpt();
           ?>
        </p>
        <p class=""><a href="<?php echo the_permalink(); ?>" class="text-white fw-bold">Continue reading...</a></p>
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
  						'posts_per_page' => 2,
  						'order' => 'ASC',
  						'paged' => get_query_var('paged'),
  					);

  					$post_query = new WP_Query($args);

    				if ($post_query->have_posts() ) {

    					while($post_query->have_posts() ) {

    						$post_query->the_post();
    						?>
      <div id="post-<?php the_ID(); ?>" class="col-6">

          <div class="row">
            <div class="col-12">
              <strong class="d-inline-block mb-2 text-primary">World</strong>
              <h3 class=""><?php echo the_title(); ?></h3>
              <div class="">Nov 12</div>
              <p class="card-text">
                <?php
  								$excerpt= get_the_excerpt();
  								echo substr($excerpt, 0, 160);
  								//echo get_the_excerpt();
  							 ?>
              </p>
              <a href="<?php echo the_permalink(); ?>" class="">Continue reading</a>
            </div>
            <div class="col-12">
              <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
              <?php
  							if ( has_post_thumbnail() ) :
  								the_post_thumbnail();
  							endif;
  						?>
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
						//'category_name' => 'beauty-business	',
						'posts_per_page' => 2,
						'order' => 'ASC',
						'paged' => get_query_var('paged'),
					);

					$post_query = new WP_Query($args);

				if($post_query->have_posts() ) {

					while($post_query->have_posts() ) {

						$post_query->the_post();
						?>

            <div id="post-<?php the_ID(); ?>" class="col-6">

                <div class="row">
                  <div class="col-12">
                    <strong class="">World</strong>
                    <h3 class=""><?php echo the_title(); ?></h3>
                    <div class="">Nov 12</div>
                    <p class="card-text">
                      <?php
        								$excerpt= get_the_excerpt();
        								echo substr($excerpt, 0, 160);
        								//echo get_the_excerpt();
        							 ?>
                    </p>
                    <a href="<?php echo the_permalink(); ?>" class="stretched-link">Continue reading</a>
                  </div>
                  <div class="col-12">
                    <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
                    <?php
        							if ( has_post_thumbnail() ) :
        								the_post_thumbnail();
        							endif;
        						?>
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
    <?php
		} ?>
  </div><!-- #content -->
</div><!-- #primary -->

<?php get_footer(); ?>
