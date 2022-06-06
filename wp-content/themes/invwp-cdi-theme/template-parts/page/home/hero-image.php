<?php $image = get_field('banner_image'); ?>
<section class="home-banner-section" >
    <div class="container" style="background-image:url('<?php echo $image['url']; ?>');background-position: center; background-repeat: no-repeat; background-size: cover;">
        <div class="row ">
            <div class="col-6 d-flex">
                <div class="banner-texts">
                  <p class="hero-text"><?php echo the_field('banner_sub_title'); ?></p>
                  <h2 class="hero-title"><?php echo the_field('banner_title'); ?></h2>
                  <p class="hero-paragraph">
                    <?php echo the_field('banner_short_description'); ?>
                  </p>
                  <p class="hero-buttons mt-30">
                    <a class="button button-primary text-uppercase" href="<?php echo site_url('/how-to-order');?>"><?php echo the_field('banner_button'); ?></a>
                  </p>
                </div>
            </div>
            <div class="col-6 mt-5 text-right">
              <div class="banner-image-wrap">
              </div>
            </div>
        </div>
      <div class="clearfix"></div>
    </div>
</section>

<section class="home-col-section text-center">
  <div class="container">
      <div class="banner-button-row">
          <div class="col-3 ">
              
                <p class="hero-buttons">
                  <a class="button button-secondary border-radius-5 font-poppins" href="<?php echo site_url('/registration');?>"><?php echo the_field('banner_section_button_text'); ?></a>
                </p>
            
          </div>
          <div class="col-3">
              
                <p class="hero-buttons">
                  <a class="button button-secondary border-radius-5 font-poppins" href="<?php echo site_url('/contact');?>"><?php echo the_field('banner_section_button_text1'); ?></a>
                </p>
            
          </div>
          <div class="col-3">
              
                <p class="hero-buttons">
                  <a class="button button-secondary border-radius-5 font-poppins" href="<?php echo site_url('/about-us/');?>"><?php echo the_field('banner_section_button_text2'); ?></a>
                </p>
            
          </div>
          <div class="col-3">
              
                <p class="hero-buttons">
                  <a class="button button-secondary border-radius-5 font-poppins" href="<?php echo site_url('/shop');?>"><?php echo the_field('banner_section_button_text3'); ?></a>
                </p>
            
          </div>
      </div>
    <div class="clearfix"></div>
  </div>
</section>
