<section class="order-online-section section-padding">
  <div class="container">
    <div class="row">
      <div class="col-6 d-flex pr-6 ">
        <div class="content-wrap">
          <h3 class="section-title pb-5"><?php echo the_field('online_title'); ?></h3>
          <p class="section-description"><?php echo the_field('online_description'); ?></p>
        </div>
      </div>
      <div class="col-6 mt-5 text-left">
        <?php
          $image =  get_field('online_image');
        ?>
        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="<?php echo $image['width']; ?>" <?php echo $image['height']; ?>/>
      </div>
    </div>
  </div>
</section>
