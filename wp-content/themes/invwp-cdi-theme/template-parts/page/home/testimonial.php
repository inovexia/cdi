<section class="home-testimonial-section full-width pb-5">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
          <h3 class="section-title">Notes from our happy customer</h3>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <!-- Slider main container -->
          <div class="home-testimonial-slider">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper1 row">
              <?php
               $args = array (
                'post_type' => 'testimonial',
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'orderby'    => 'date',
                'order'      => 'DESC',
                'hide_empty' => false,
               );
               $query = new WP_Query($args);
               if ($query->have_posts()) {
                 while ($query->have_posts()) {
                  $query->the_post();
                  // get the image URL
                  $image = wp_get_attachment_url ( get_post_thumbnail_id ( get_the_Id()));
                  ?>
                  <!-- Slides -->
                  <div class="swiper-slide1 col-4 text-center">
                     <div class="slide-image">
                       <img src="<?php echo $image; ?>" alt="<?php the_title(); ?>" width='319' height='427' />
                     </div>
                     <div class="testimonial-title my-5">
                       <h6 class="slide-meta text-center">
                          <?php the_title(); ?>
                       </h6>
                     </div>
                     <p class="slide-excerpt mb-5">
                        <?php
        								$excerpt= get_the_excerpt();
        								echo substr($excerpt, 0, 160);
        								?>
                     </p>
                  </div>
                   <?php
                 }
                 wp_reset_postdata();
               }
               ?>
            </div>

          </div>
        </div>
      </div>
  </div>
</section>
