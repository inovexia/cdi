<section class="home-about-us">
  <div class="container">
    <div class="row">
      <div class="col-5 mt-5 text-left">
        <h3 class="section-title text-center mb-5"><?php echo the_field('about_title'); ?></h3>
        <?php
          $image =  get_field('about_image');
        ?>
        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="<?php echo $image['width']; ?>" <?php echo $image['height']; ?>/>
      </div>
      <div class="col-7 d-flex">
        <div class="content-wrap px-10">
          <h3 class="section-title"><?php echo the_field('about_title'); ?></h3>
          <p class="section-description"><?php echo the_field('about_description'); ?></p>
          <p class="mt-30">
            <a class="button button-primary text-uppercase" href="<?php echo site_url('/about-us');?>"><?php echo the_field('about_button_text'); ?></a>
          </p>
        </div>
      </div>
    </div>
  </div>
</section>
