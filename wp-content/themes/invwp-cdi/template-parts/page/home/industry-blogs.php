<section class="home-industry-section full-width">
    <div class="container">
        <div class="row industry-header">
            <div class="col-6">
                <h6 class="subtitle-secondary text-uppercase"><?php echo the_field('industry_sub_title'); ?></h6>
                <h2 class="section-title"><?php echo the_field("industry_title"); ?></h2>
            </div>
            <div class="col-6 text-right header-btn">
                <a class="button button-secondary"
                    href="<?php echo site_url('industry');?>"><?php echo the_field('industry_button'); ?></a>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <!-- Slider main container -->
                <div class="home-industry-slider swiper">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
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
               if ($query->have_posts()) {
                 while ($query->have_posts()) {
                  $query->the_post();
                  // get the image URL
                  $image = wp_get_attachment_url ( get_post_thumbnail_id ( get_the_Id()));
                  ?>
                        <!-- Slides -->
                        <div class="swiper-slide">
                            <div class="slide-image">
                                <img src="<?php echo $image; ?>" alt="<?php the_title(); ?>" width='319' height='427' />
                            </div>
                            <h6 class="slide-meta text-uppercase">published on eyecare BY <?php the_author(); ?>
                            </h6>

                            <a class="slide-title" href="<?php echo the_permalink (); ?>">


                                <?php 
                                $var = get_the_title();
                                    if(strlen($var) > 80){
                                        echo substr($var,0,80) . " ...";
                                    }
                                    else{
                                        echo $var;
                                    }
                                ?>



                            </a>

                            <p class="slide-excerpt">
                                <?php 
                                  $excerpt= get_the_excerpt();
                                      if(strlen($excerpt) > 160){
                                          echo substr($excerpt,0,160) . " ...";
                                      }
                                      else{
                                          echo $excerpt;
                                      }
                                  ?>

                            </p>
                        </div>
                        <?php
                 }
               }
               wp_reset_query();
               ?>
                    </div>
                    <div class="slider-footer-btn">
                        <a class="button button-secondary"
                            href="<?php echo site_url('industry');?>"><?php echo the_field('industry_button'); ?></a>
                    </div>
                    <!-- If we need pagination -->
                    <div class="swiper-pagination"></div>
                    <div class="industry-arrow-slider">
                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>