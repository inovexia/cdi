<section class="referall-top" style="background-image:url('<?php echo the_field("banner_image") ?>');background-position: center; background-repeat: no-repeat; background-size: cover; ">
  <div class="container">

    <div class="row ">

      <div class="col-6">
        <?php get_template_part( 'template-parts/nav/breadcrumb', 'nav'); ?>
      </div>

      <div class="col-6">
        <div class="referall-form">
          <h4 class=""><?php echo the_field("referall_title") ?></h4>
          <p class=""><?php echo the_field("referall_content") ?></p>
          <?php echo get_post_field( 'post_name', get_the_ID()) === 'referral' ? do_shortcode('[contact-form-7 id="724" title="Referals"]') : do_shortcode('[contact-form-7 id="771" title="Referals"]'); ?>
        </div>
      </div>
    </div>
  </div>
</section>