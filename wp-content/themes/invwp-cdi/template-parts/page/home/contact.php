<section class="home-contact-section" >
  <div class="container">
    <div class="row ">
      <div class="col-6 d-flex">
        <div class="">
          <h6 class="subtitle-primary text-uppercase"><?php  the_field('contact_sub_title'); ?></h6>
            <h2 class="section-title text-uppercase"><?php  the_field('contact_title'); ?></h2>
            <p class="section-description"><?php the_field('contact_description'); ?></p>
            <?php echo do_shortcode('[contact-form-7 id="5" title="Contact form 1"]'); ?>
            <p class="mt-30">
              <a class="button button-primary" href="<?php echo site_url('contact');?>"><?php the_field('contact_button1'); ?></a>
            </p>
        </div>
      </div>
      <div class="col-6 text-right">
      </div>
    </div>
  </div>
</section>
