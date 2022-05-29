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
                'posts_per_page' => 9,
                'orderby'    => 'date',
                'order'      => 'DESC',
                'hide_empty' => false,
               );
               $query = new WP_Query($args);
               if ($query->have_posts()) { ?>
                 <?php
                 while ($query->have_posts()) {
                  $query->the_post();
                    ?>
                      <!-- Slides -->
                      <div class="swiper-slide col-3 px-5">
                         <div class="slide-image">
                           <?php invwp_post_thumbnail () ?>
                         </div>
                         <h6 class="slide-meta text-uppercase">
                         </h6>
                         <div class="home-industry-title">
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

                <?php } ?>
                 <!-- end of the loop -->
               </div>
             </div>

          </div>
        </div>
      </div>
  </div>
</section>
