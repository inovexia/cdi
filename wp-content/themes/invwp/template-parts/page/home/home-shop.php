<section class="home-shop">
  <div class="container">
    <div class="row">
      <div class="col-12">
          <h1 class="section-title text-center"><?php echo the_field('home_shop_main_title'); ?></h1>
      </div>
    </div>
    <div class="row">
      <div class="col-6 d-flex">
        <div class="content-wrap">
          <!--<h6 class="subtitle-primary"><?php //echo the_field('home_sub_title'); ?></h6>-->
          <h2 class="section-title"><?php echo the_field('home_shop_title'); ?></h2>
          <p class="section-description"><?php echo the_field('home_shop_description'); ?></p>
          <p class="mt-30">
            <a class="button button-primary text-uppercase" href="<?php echo site_url('about');?>"><?php echo the_field('home_shop_button_title'); ?></a>
          </p>
        </div>
      </div>
      <div class="col-6 mt-5 text-right">
        <?php
          $image =  get_field('home_shop_image');
        ?>
        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="<?php echo $image['width']; ?>" <?php echo $image['height']; ?>/>
      </div>
    </div>
  </div>
</section>
