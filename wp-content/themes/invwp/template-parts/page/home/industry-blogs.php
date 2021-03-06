<section class="home-industry-section full-width">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
          <h3 class="section-title">Health blog & articles<?php //echo the_field("industry_title"); ?></h3>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <!-- Slider main container -->
          <div class="home-industry-slider">
            <div class="overflow-hidden swiper blogSwiper">
              <!-- Additional required wrapper -->
              <div class="swiper-wrapper position-relative row">
              <?php
               $args = array (
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'orderby'    => 'date',
                'order'      => 'DESC',
                'hide_empty' => false,
               );
               $query = new WP_Query($args);
               if ($query->have_posts()) { ?>
                 <?php
                 while ($query->have_posts()) {
                  $query->the_post();
                  // get the image URL
                  $image = wp_get_attachment_url ( get_post_thumbnail_id ( get_the_Id()));
                  ?>
                      <!-- Slides -->
                      <div class="swiper-slide col-4 px-5">
                         <div class="slide-image">
                           <img src="<?php echo $image; ?>" alt="<?php the_title(); ?>" width='319' height='427' />
                         </div>
                         <h6 class="slide-meta text-uppercase">
                         </h6>
                         <div class="home-industry-title px-6 my-5">
                           <h5 class="text-left my-5">
                              <a class="slide-title" href="<?php echo the_permalink (); ?>"><?php the_title(); ?></a>
                           </h5>
                           <div class="post-meta text-left my-4">
                            <?php echo get_the_date( 'F d, Y' ); ?>
                           </div>
                           <p class="slide-excerpt text-left mb-5 mt-5">
                              <?php
              								$excerpt= get_the_excerpt();
              								echo substr($excerpt, 0, 160);
              								?>
                           </p>
                           <div class="read-more text-right">
                             <a href="<?php echo the_permalink (); ?>">Read more&nbsp;<i class="fas fa-arrow-right pl-5"></i></a>
                           </div>
                         </div>
                      </div>
                   <?php
                 } ?>
               <?php
                 wp_reset_postdata();
                  } else { ?>
                  <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
                <?php } ?>
                 <!-- end of the loop -->
               </div>
             </div>

          </div>
        </div>
      </div>
  </div>
</section>
