<section class="home-shop">
  <div class="container">
    <div class="row">
      <div class="col-12">
          <h3 class="section-title text-center"><?php echo the_field('home_shop_main_title'); ?></h3>
      </div>
    </div>
    <div class="row">
      <div class="col-5 d-flex">
        <div class="content-wrap pr-10">
          <?php $vupload_dir = wp_upload_dir();
            $imagem =  get_field('home_shop_image');
            //$mplayimage =  get_field('home_shop_play_image');
          ?>
          <video width="100%" height="349" poster="<?php echo $image['url']; ?>" controls>
              <source src="<?php echo $vupload_dir['baseurl']; ?>/2022/04/1590252299.mp4" type="video/mp4">
              <source src="video.ogg" type="video/ogg">
              <source src="video.webm" type="video/webm">
              <object data="video.mp4" width="100%" height="349">
              <embed src="video.swf" width="100%" height="349">
              </object>
          </video>
          <img class="my-5" src="<?php echo $imagem['url']; ?>" alt="<?php echo $imagem['alt']; ?>" width="<?php echo $imagem['width']; ?>" <?php echo $imagem['height']; ?>/>

          <h3 class="section-title mb-5"><?php echo the_field('home_shop_title'); ?></h3>
          <p class="section-description"><?php echo the_field('home_shop_description'); ?></p>
          <p class="mt-30">
            <a class="button button-primary text-uppercase" href="<?php echo site_url('about');?>"><?php echo the_field('home_shop_button_title'); ?></a>
          </p>
        </div>
      </div>
      <div class="col-7 text-right">
        <?php $upload_dir = wp_upload_dir();
          $image =  get_field('home_shop_image');
          //$playimage =  get_field('home_shop_play_image');
        ?>
        <video width="737" height="349" poster="<?php echo $image['url']; ?>" controls>
            <source src="<?php echo $upload_dir['baseurl']; ?>/2022/04/1590252299.mp4" type="video/mp4">
            <source src="video.ogg" type="video/ogg">
            <source src="video.webm" type="video/webm">
            <object data="video.mp4" width="737" height="349">
            <embed src="video.swf" width="737" height="349">
            </object>
        </video>
        <!--<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="<?php echo $image['width']; ?>" <?php echo $image['height']; ?>/>-->

      </div>
    </div>
  </div>
</section>
