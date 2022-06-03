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
<main id="main" class="single-blog" role="main">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h1 class="post-title-inner section-title"><?php echo the_title(); ?></h1>
                <div class="archive-meta ">
                    <p>Publish On <strong><span><?php $category = get_the_category();
												 $allcategory = get_the_category();
											foreach ($allcategory as $category) {
												$cat_link = get_category_link($category->cat_ID);
											?>
                                <a href="<?php echo $cat_link; ?>"
                                    class="card-link"><strong><?php echo $category->cat_name;; ?></strong></a>
                                <?php
											}
											?></span></strong> By <strong><?php the_author(); ?></strong></p>
                    </p>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-12">
                <div class="wrap-content">
                    <?php
               // Start the loop.
               while ( have_posts() ) : the_post();
               
               	/*
               	 * Include the post format-specific template for the content. If you want to
               	 * use this in a child theme, then include a file called called content-___.php
               	 * (where ___ is the post format) and that will be used instead.
               	 */
                  // get_template_part( 'content', get_post_format() );?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="row">
                            <div class="col-12">
                            <div class="post-thumbnail text-center blog-big-image">
                                    <?php
                              if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                              the_post_thumbnail( 'post-thumbnail' );
                              }
                              //the_post_thumbnail(array(250, 250)); ?>
                                </div>
                                <div class="entry-content"><?php the_content(); ?></div>
                            </div>
                        </div>
                </div>
                </article>
                <?php
               // End the loop.
               endwhile;
               
               ?>
            </div>
        </div>
    </div>
    </div>

    </div>
</main>
<!-- .site-main -->
<?php
get_footer();