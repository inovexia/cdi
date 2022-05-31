<section class="order-banner-section full-width">
    <div class="container">
        <div class="row ">
            <div class="col-6 d-flex">
                <div class="banner-texts">
                  <p class="hero-text"><?php echo the_field('banner_sub_title'); ?></p>
                  <h2 class="hero-title"><?php echo the_field('banner_title'); ?></h2>
                </div>
            </div>
            <div class="col-6 mt-5 text-right">
            </div>
        </div>
      <div class="clearfix"></div>
    </div>
</section>

<section class="how-to-order-section full-width">
    <div class="container">
        <div class="row ">
            <div class="col-12 text-center">
                <div class="banner-texts">
                  <h2 class="section-title"><?php echo the_field('about_order_title'); ?></h2>
				  <p class="section-description"><?php echo the_field('about_order_description'); ?></p>
                </div>
            </div>
        </div>
      <div class="clearfix"></div>
    </div>
</section>

<section class="order-col-section text-center section-padding">
  <div class="container">
      <div class="row">
	  <?php if (have_rows('lists_orders')) : ?>
	  <?php
        $y = 0;;
        while (have_rows('lists_orders')) : the_row();
          $y++;
          $tCount = $y;
          ?>
          <div class="col-4">
              <div class="">
				<p class="section-icon pb-5"><i class="fas <?php echo the_sub_field('lists_order_icons'); ?> pl-5"></i></p>
				<h3 class="section-title "><?php echo the_sub_field('list_order_title'); ?></h3>
				<p class="section-description"><?php echo the_sub_field('lists_order_description'); ?></p>
              </div>
          </div>
		  <?php endwhile; ?>
		  <?php else : endif; ?>
      </div>
    <div class="clearfix"></div>
  </div>
</section>
