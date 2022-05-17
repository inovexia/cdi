<section class="faq-section section-padding">
  <div class="container body-container">
    <div class="row">
      <div class="col-md-10 mx-auto">
        <h2 class="syncopate-normal-black-pearl-24px text-center">FAQ's</h2>
        <p class="montserrat-semi-bold-ebony-clay-10px text-center">If you cannot find an answer to your question below, please <a href="<?php echo site_url(); ?>/contact/">contact a customer service representative.</a></p>
        <?php if (have_rows('faq_collapse')) : ?>
        <div class="accordion " id="accordionExample">
          <?php $y = 0;;
            while (have_rows('faq_collapse')) : the_row();
              $y++;
              $tCount = $y; ?>
          <div class="accordion-item">
            <h4 class="accordion-header" id="heading<?php echo $tCount; ?>" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $tCount; ?>" aria-expanded="true"
              aria-controls="collapse<?php echo $tCount; ?>">
              <span class="accordion-button montserrat-normal-ebony-clay-12px"><?php the_sub_field('accordion_title'); ?></span>
            </h4>
            <div id="collapse<?php echo $tCount; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $tCount; ?>" data-bs-parent="#accordionExample">
              <div class="accordion-body montserrat-normal-ebony-clay-12px">
                <?php the_sub_field('accordion_description'); ?>
              </div>
            </div>
          </div>
          <?php endwhile; ?>
        </div>
        <?php else : endif; ?>
      </div>
    </div>
  </div>
</section>
