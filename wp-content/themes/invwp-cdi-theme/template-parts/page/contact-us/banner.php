<!-- <section class="contact-banner">
	<div class="container">
	  <div class="bg-dark px-4 py-5 text-center">
		<div class="py-5">
		  <h2 class="section-title"><?php echo the_field('contact_banner_title'); ?></h2>
		  <div class="col-lg-6 mx-auto">
			<p class="section-description mb-4"><?php echo the_field('contact_banner_description'); ?></p>
		  </div>
		</div>
	  </div>  
	</div> 
</section> -->
  <div class="b-example-divider mb-0"></div>
  
<section class="contact-col-section text-center">
  <div class="container">
      <div class="row">
	  <?php if (have_rows('contact_address_section')) : ?>
	  <?php
        $y = 0;;
        while (have_rows('contact_address_section')) : the_row();
          $y++;
          $tCount = $y;
          ?>
          <div class="col-4">
              <div class="">
				<p class="section-icon mb-3"><i class="fas <?php echo the_sub_field('address_icon'); ?>"></i></p>
				<h5 class=""><?php echo the_sub_field('address_title'); ?></h5>
				<p class="section-description"><?php echo the_sub_field('address_description'); ?></p>
              </div>
          </div>
		  <?php endwhile; ?>
		  <?php else : endif; ?>
      </div>
    <div class="clearfix"></div>
  </div>
</section>