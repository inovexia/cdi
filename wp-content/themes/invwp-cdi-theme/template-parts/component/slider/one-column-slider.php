<section class="testimonial-wrp">
  <div class="container">
    <h5 class="subtitle-primary">What Our Students Say?</h5>
    <div class="row sec-row-margin">

      <div class="swiper swiper-container one-column-slider">
        <div class="swiper-wrapper">
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
          <div class="swiper-slide">
            <div class="row">
              <div class="col-12">
                <div class="test-back-column text-center">
                  <div class="slide-image mt-5 testimonial-awtar">
                    <img src="<?php echo $image; ?>" alt="<?php the_title(); ?>" width='319' height='427' />
                  </div>
                  <p class="slide-excerpt">
                    <?php
                          //$excerpt= get_the_excerpt();
                          //echo substr($excerpt, 0, 160);
                          ?>
                    <?php the_content(); ?>
                  </p>

                  <h5 class="mb-5">"<?php the_field('review_title'); ?>"</h5>
                  <h6 class="mb-5"><?php the_title(); ?></h6>
                  <ul class="testimonial-star">
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                  </ul>

                </div>
              </div>


              <!-- <h6 class="text-left">
                <a class="slide-title text-uppercase" href="<?php echo the_permalink (); ?>"><?php the_title(); ?></a>
              </h6> -->


            </div>



          </div>
          <?php
                 }
               }
               ?>
        </div>
      </div>
      <div class="navigate-btn">
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
      </div>
    </div>
  </div>
</section>