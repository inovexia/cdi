<div class="container ">
    <section class="about-content-section about-sec-one">
      <div class="container">
        <div class="row flex-lg-row-reverse align-items-center gx-0">
          <div class="col-12 col-md-6 about-content-left-column order-md-2 order-lg-1 order-2">
            <div class="about-inner-text referral-data">
              <h4 class="montserrat-normal-ebony-clay-48px">
                <?php echo the_field('about_profile_title'); ?>
              </h4>
              <h1 class="montserrat-normal-ebony-clay-48px">
                <?php echo the_field('about_profile_title1'); ?>
              </h1>
              <div class="montserrat-normal-ebony-clay-12px">
                <p>
                  <?php echo the_field('about_profile_content'); ?>
                </p>
              </div>
              <div class="">
                <?php
                $btn_link = get_field('about_profile_button_link');
                ?>
                <a class="montserrat-normal-mexican-red-18px referal-btn" href="#">
                  <?php echo the_field('about_button'); ?>
                </a>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6 order-md-1 order-lg-2 order-1">
            <img src="<?php echo the_field('about_profile_image'); ?>" class="img-fluid" alt="<?php echo bloginfo('name'); ?>" loading="lazy" />
          </div>
        </div>
      </div>
    </section>
  </div>

  <div class="b-example-divider"></div>
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
  </div>

  <div class="b-example-divider"></div>
  <div class="container ">
    <section class="about-content-section">
      <div class="container">
        <div class="bg-dark text-secondary text-center">
          <div class="">
            <h1 class="">Dark mode hero</h1>
            <div class="col-6">
              <p class="">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
              <div class="">
                <button type="button" class="btn btn-outline-info btn-lg px-4 me-sm-3 fw-bold">Custom button</button>
                <button type="button" class="btn btn-outline-light btn-lg px-4">Secondary</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <div class="b-example-divider mb-0"></div>
