<div class="container ">
  <section class="about-main-banner text-center"
    style="background-image:url('<?php echo the_field("about_banner_image"); ?>');background-position: top center; background-repeat: no-repeat; background-size: cover; ">

    <div class="container">
      <div class="text-center">
        <h1 class="">About Us</h1>
        <div class="col-lg-6">
          <p class=""><?php echo the_field("about_title"); ?></p>
          <h3 class=""><?php echo the_field("about_content"); ?></h3>
          <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
            <button type="button" class="btn btn-primary">Primary button</button>
            <p class=""><a href="#" class="btn btn-secondary">Learn more</a></p>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
