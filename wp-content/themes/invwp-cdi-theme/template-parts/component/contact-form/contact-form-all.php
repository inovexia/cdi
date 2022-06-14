<section class="home-contact-section" style="background-image:url('<?php the_field("contact_image"); ?>'); background-repeat: no-repeat; background-size: cover; ">
  <div class="container">
    <div class="row form-outer">
      <div class="col-6 d-flex">
        <div class="contact-common">
          <h6 class="subtitle-primary text-uppercase"><?php echo the_field('contact_sub_title'); ?></h6>
          <h2 class="section-title"><?php the_field('contact_title'); ?></h2>
          <p class="section-description"><?php the_field('contact_description'); ?></p>
          <?php echo do_shortcode('[contact-form-7 id="746" title="Contact form 1"]'); ?>
          
        </div>
      </div>
      <div class="col-6 text-right">
      </div>
    </div>
  </div>
</section>