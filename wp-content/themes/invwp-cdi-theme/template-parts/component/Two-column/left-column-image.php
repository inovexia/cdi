<section class="two-column-wrp">
  <div class="container">
    <div class="row">
      <div class="col-8">
        <?php $two_column_image = get_field('two_column_image'); ?>
        <img src="<?php echo $two_column_image['url'];?>" class="img-fluid" alt="30 Years Experience">
      </div>
      <div class="col-4">
        <h3 class="mb-5 section-title"><?php echo the_field('two_column_heading'); ?></h3>
        <p class="mb-5"><?php echo the_field('two_column_paragraph'); ?></p>
        <a href="<?php echo site_url();?>/">Read More</a>
      </div>
    </div>
  </div>
</section>