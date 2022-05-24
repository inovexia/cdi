<section class="two-column-about-wrp ">
  <div class="container">
    <div class="row">
      <div class="col-6">
        <h3 class="mb-5 section-title"><?php echo the_field('about_profile_title'); ?></h3>
        <p class="mb-5"><?php echo the_field('about_profile_content'); ?></p>
      </div>
      <div class="col-6">
        <?php $about_profile_image = get_field('about_profile_image'); ?>
        <img src="<?php echo $about_profile_image['url'];?>" class="img-fluid" alt="30 Years Experience">
      </div>
    </div>
  </div>
</section>