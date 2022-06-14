<section class="order-by-phone-section">
  <div class="container">
    <div class="row">
      <div class="col-6 mt-5 text-left desktop-order-phone">
        <?php
          $image =  get_field('phone_image');
        ?>
        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="<?php echo $image['width']; ?>" <?php echo $image['height']; ?>/>
      </div>
      <div class="col-6 d-flex">
        <div class="content-wrap">
          <h3 class="section-title pb-5"><?php echo the_field('phone_title'); ?></h3>
          <p class="section-description"><?php echo the_field('phone_description'); ?></p>
        </div>
      </div>
      <div class="col-6 mt-5 text-left mobile-order-phone">
        <?php
          $image =  get_field('phone_image');
        ?>
        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="<?php echo $image['width']; ?>" <?php echo $image['height']; ?>/>
      </div>
    </div>
  </div>
</section>
