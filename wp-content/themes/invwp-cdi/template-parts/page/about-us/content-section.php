<section class="about-content-section about-sec-one">
  <div class="container">
	<div class="row flex-lg-row-reverse align-items-center gx-0">
	  <div class="col-6">
		<?php
		  $image =  get_field('about_image');
		?>
		<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" width="<?php echo $image['width']; ?>" <?php echo $image['height']; ?> loading="lazy">
	  </div>
	  <div class="col-6 about-content-left-column">
		<div class="about-inner-text referral-data">
		  <h2 class="section-title">
			<?php echo the_field('about_column_title'); ?>
		  </h2>
		  <p class="section-description mb-4"><?php echo the_field("about_column_description"); ?></p>
		</div>
	  </div>
	</div>
  </div>
</section>
	
<?php/*
  <!--<div class="b-example-divider"></div>
  <div class="container ">
    <section class="about-content-section about-sec-two">
      <div class="container">
        <div class="row align-items-center flex-lg-row-reverse">
          <div class="col-12 col-md-6 order-1 order-md-2 order-lg-1">
            <img src="<?php echo the_field('about_profile_image2'); ?>" class="img-fluid" alt="<?php echo bloginfo('name'); ?>" loading="lazy">
          </div>
          <div class="col-12 col-md-6 order-2 order-md-1 order-lg-2 about-content-right-column ">
            <div class="about-inner-text referral-data">
              <h4 class="montserrat-normal-ebony-clay-48px"><?php echo the_field('about_profile_title2'); ?></h4>
              <h1 class="montserrat-normal-ebony-clay-48px">
                <?php echo the_field('about_profile_title1'); ?>
              </h1>
              <div class="montserrat-normal-ebony-clay-12px">
                <p><?php echo the_field('about_profile_content2'); ?></p>
              </div>
              <div class="">
                <?php
                $btn_link = get_field('about_profile_button_link2');
                ?>
                <a class="montserrat-normal-mexican-red-18px referal-btn" href="#">
                  <?php echo the_field('about_button'); ?>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>-->*/ ?>

<section class="about-content-section">
  <div class="container">
	<div class="bg-dark text-center">
	  <h2 class="section-title">
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