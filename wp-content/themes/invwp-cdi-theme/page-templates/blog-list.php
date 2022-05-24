<?php
/* Template Name: All Blogs */

get_header();
?>

<div id="primary" class="site-content blog-page">
  <main id="main" class="site-main">
    <div class="container">
      <?php
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    // are we on page one?
    if (1 == $paged) { ?>
      <?php
          $args = array(
             'post_type' => 'post',
             'order'     => 'ASC',
             "posts_per_page" => 1 
          );

          $post_query = new WP_Query($args);

          if($post_query->have_posts() ) {
            while($post_query->have_posts() ) {
             $post_query->the_post();
             ?>
      <div class="row first-blog-row">
        <div class="col-6">
    <a href="<?php the_permalink(); ?>">
          <?php
                     if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                       the_post_thumbnail( 'large' );
                     }
                    ?>
          </a>
        </div>
        <div class="col-6 first-blog-column-text">
          <p>Publish On <strong><span><?php $category = get_the_category();
                         $allcategory = get_the_category();
                      foreach ($allcategory as $category) {
                        $cat_link = get_category_link($category->cat_ID);
                      ?>
                <a href="<?php echo $cat_link; ?>" class="card-link"><strong><?php echo $category->cat_name;; ?></strong></a>
                <?php
                      }
                      ?></span></strong> By <strong><?php the_author(); ?></strong></p>
          <h3 class="section-title"><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></h3>
          <div class="main-para mb-4">
            <?php $excerpt= get_the_excerpt();
            echo substr($excerpt, 0, 90); ?>

          </div>
      <div class="blog-btn">
      <a href="<?php the_permalink(); ?>" class="main-btn">Read More</a>
      </div>
          
        </div>
      </div>
      <?php
          }
        }

        ?>
    </div>
    <?php
          }
        

        ?>
    <div class="container">

      <div class="blog-row">
        <?php
          $args = array(
             'post_type' => 'post',
             'order'     => 'ASC',
             "posts_per_page" => 6,
             'paged' => get_query_var('paged'), 
          );

          $post_query = new WP_Query($args);

          if($post_query->have_posts() ) {
            while($post_query->have_posts() ) {
             $post_query->the_post();
             ?>
        <div class="col-4 blog-column">
    <a href="<?php the_permalink(); ?>">
          <?php
                     if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                       the_post_thumbnail( 'large' );
                     }
                    ?>
</a>
          <p>Publish On <strong><span><?php $category = get_the_category();
                         $allcategory = get_the_category();
                      foreach ($allcategory as $category) {
                        $cat_link = get_category_link($category->cat_ID);
                      ?>
                <a href="<?php echo $cat_link; ?>" class="card-link"><strong><?php echo $category->cat_name;; ?></strong></a>
                <?php
                      }
                      ?></span></strong> By <strong><?php the_author(); ?></strong></p>

          <h3 class="sub-heading"><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></h3>
          <div class="main-para mb-4">
            <?php $excerpt= get_the_excerpt();
            echo substr($excerpt, 0, 90); ?>

          </div>
          <div class="blog-btn">
      <a href="<?php the_permalink(); ?>" class="main-btn">Read More</a>
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