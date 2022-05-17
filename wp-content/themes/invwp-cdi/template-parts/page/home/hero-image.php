<section class="home-banner-section full-width">
    <div class="container">
        <div class="row ">
            <div class="col-6 d-flex">
                <div class="">
                    <h4 class="subtitle-primary"><?php echo the_field('banner_sub_title'); ?></h4>
                    <h2 class="hero-title"><?php echo the_field('banner_title'); ?></h2>
                    <div class="mob-banner">

                    <?php
                      $image_back =  get_field('banner_image');
                      //print_r ($image_back);
                      $image_front = get_field('banner_image1');
                    ?>
                    <img class="banner-image-back" width="<?php echo $image_back['width']; ?>" height="auto"
                        src="<?php echo $image_back['url']; ?>" alt="<?php echo $image_m['alt']; ?>" />
                    <img class="banner-image-front" width="<?php echo $image_front['width']; ?>" height="auto"
                        src="<?php echo $image_front['url']; ?>" alt="<?php echo $image_front['alt']; ?>"  />

                    </div>
                    <p class="hero-text">
                        <?php echo the_field('banner_short_description'); ?>
                    </p>


                    <p class="hero-buttons mt-30">
                        <a class="button button-primary text-uppercase"
                            href="<?php echo get_permalink( wc_get_page_id( 'shop' ) );?>"><?php echo the_field('banner_button1'); ?></a>
                        <a class="button button-secondary text-uppercase"
                            href="<?php echo site_url('about');?>"><?php echo the_field('banner_button2'); ?></a>
                    </p>

                </div>
            </div>
            <div class="col-6 text-right">
                <div class="banner-image-wrap">
                    <?php
                $image_back =  get_field('banner_image');
                //print_r ($image_back);
                $image_front = get_field('banner_image1');
              ?>
                    <img class="banner-image-back" width="<?php echo $image_back['width']; ?>" height="auto"
                        src="<?php echo $image_back['url']; ?>" alt="<?php echo $image_m['alt']; ?>" loading="lazy" />
                    <img class="banner-image-front" width="<?php echo $image_front['width']; ?>" height="auto"
                        src="<?php echo $image_front['url']; ?>" alt="<?php echo $image_front['alt']; ?>"
                        loading="lazy" />
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</section>
