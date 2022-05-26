<section class=" about-sec-one section-padding">
  <div class="container">
	<div class="row flex-lg-row-reverse align-items-center gx-0">
	  <div class="col-6">
		<?php
		  $image =  get_field('about_image');
		?>
		<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="<?php echo $image['width']; ?>" <?php echo $image['height']; ?> loading="lazy">
	  </div>
	  <div class="col-6 about-content-left-column d-flex">
		<div class="about-inner-text referral-data">
		  <h2 class="section-title mb-5">
			<?php echo the_field('about_column_title'); ?>
		  </h2>
		  <p class="section-description mb-4"><?php echo the_field("about_column_description"); ?></p>
		</div>
	  </div>
	</div>
  </div>
</section>


<section class="section-margin better-choice section-padding">
  <div class="container">
	<div class="bg-dark text-center">
	  <h2 class="section-title mb-5">
			<?php echo the_field('about_choice_title'); ?>
	  </h2>
	  <p class="section-description mb-4"><?php echo the_field("about_choice_description"); ?></p>
	  <p class="mt-30">
		<a class="button button-primary text-uppercase" href="<?php echo site_url('how-to-order');?>"><?php echo the_field('about_choice_button'); ?></a>
		<a class="button button-primary text-uppercase" href="<?php echo site_url();?>"><?php echo the_field('about_choice_button1'); ?></a>
	  </p>
	</div>
  </div>
</section>
