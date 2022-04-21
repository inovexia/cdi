<section class="home-shop section-padding">
  <div class="container">
    <div class="row">
      <div class="col-12">
          <h3 class="section-title text-center"><?php echo the_field('home_shop_main_title'); ?></h3>
      </div>
    </div>
    <div class="row">
      <div class="col-5 d-flex">
        <div class="content-wrap pl-6 pr-10">
          <h3 class="section-title"><?php echo the_field('home_shop_title'); ?></h3>
          <p class="section-description"><?php echo the_field('home_shop_description'); ?></p>
          <p class="mt-30">
            <a class="button button-primary text-uppercase" href="<?php echo site_url('about');?>"><?php echo the_field('home_shop_button_title'); ?></a>
          </p>
        </div>
      </div>
      <div class="col-7 mt-5 text-right">
        <?php
          $image =  get_field('home_shop_image');
        ?>
        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="<?php echo $image['width']; ?>" <?php echo $image['height']; ?>/>
      </div>
    </div>
  </div>
</section>
