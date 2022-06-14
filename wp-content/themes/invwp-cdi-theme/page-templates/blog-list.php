<?php
/* Template Name: All Blogs */

get_header();
?>

<div id="primary" class="site-content blog-page section-padding">
    <main id="main" class="site-main">
        <div class="container">
            <div class="entry-header">
                <h1><strong>Community</strong> Articles</h1>
                <p>Disclaimer: Please note that the contents of these community articles are strictly for informational
                    purposes and should not be considered as medical advice. These community articles are not written or
                    reviewed for medical validity by Canadian Insulin or its staff. All views and opinions expressed by
                    the contributing authors in these community articles are not endorsed by Canadian Insulin. Always
                    consult a medical professional for medical advice, diagnosis, and treatment.</p>
            </div>
            <div class="blog-row">
                <?php
          $args = array(
             'post_type' => 'post',
             'order'     => 'DESC',
             "posts_per_page" => 6,
             'paged' => get_query_var('paged'), 
          );

          $post_query = new WP_Query($args);

          if($post_query->have_posts() ) {
            while($post_query->have_posts() ) {
             $post_query->the_post();
             ?>
                <div class="col-4 blog-column">
                    <div class="blog-image">
                        <a href="<?php the_permalink(); ?>">
                            <?php
                     if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                       the_post_thumbnail( 'large' );
                     }
                    ?>
                        </a>
                    </div>
                    <div class="blog-content">
                        <h3 class="sub-heading"><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></h3>
                        <p>Post Date: <strong><span><?php echo get_the_date( 'dS M Y', $post->ID ); ?></span></strong>
                        </p>
                        <div class="main-para mb-4">
                            <?php $excerpt= get_the_excerpt();
            echo substr($excerpt, 0, 90); ?>

                        </div>
                        <div class="blog-btn">
                            <a href="<?php the_permalink(); ?>">Read More</a>
                        </div>
                    </div>
                </div>
                <?php
            }
          }
        ?>
            </div>

        </div>
        <div class="clearfix"></div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
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

          
        ?>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </main>
</div><!-- #primary -->
<?php get_footer(); ?>