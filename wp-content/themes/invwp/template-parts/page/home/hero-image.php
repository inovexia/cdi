<section class="home-banner-section full-width" style="background-image:url('<?php echo the_field("banner_image"); ?>');background-position: top center; background-repeat: no-repeat; background-size: cover; ">
    <div class="container">
        <div class="row ">
            <div class="col-6 d-flex">
                <div class="">
                  <p class="hero-text"><?php echo the_field('banner_sub_title'); ?></p>
                  <h2 class="hero-title"><?php echo the_field('banner_title'); ?></h2>
                  <p class="hero-text">
                    <?php echo the_field('banner_short_description'); ?>
                  </p>
                  <p class="hero-buttons mt-30">
                    <a class="button button-primary text-uppercase" href="<?php echo site_url('about');?>"><?php echo the_field('banner_button'); ?></a>
                  </p>
                </div>
            </div>
            <div class="col-6 mt-5 text-right">
              <div class="banner-image-wrap">
                <?php
                  $image_back =  get_field('banner_image');
                  //print_r ($image_back);
                ?>
                <img class="banner-image-back" width="<?php echo $image_back['width']; ?>" height="auto" src="<?php echo $image_back['url']; ?>" alt="<?php echo $image_m['alt']; ?>" loading="lazy" />
              </div>
            </div>
        </div>
      <div class="clearfix"></div>
    </div>
</section>
