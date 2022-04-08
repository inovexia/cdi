<div class="container body-container">
  <section class="faq-section section-padding">
    <div class="container">
      <h2 class="syncopate-normal-black-pearl-24px">Frequently Asked Questions</h2>
      <?php if (have_rows('faq_collapse')) : ?>
      <div class="accordion " id="accordionExample">
        <?php $y = 0;;
          while (have_rows('faq_collapse')) : the_row();
            $y++;
            $tCount = $y; ?>
        <div class="accordion-item">
          <h4 class="accordion-header lato-bold-black-pearl-12px" id="heading<?php echo $tCount; ?>" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $tCount; ?>" aria-expanded="true"
            aria-controls="collapse<?php echo $tCount; ?>">
            <span class="accordion-button"><?php the_sub_field('accordion_title'); ?></span>
          </h4>
          <div id="collapse<?php echo $tCount; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $tCount; ?>" data-bs-parent="#accordionExample">
            <div class="accordion-body lato-normal-black-pearl-14px">
              <?php the_sub_field('accordion_description'); ?>
            </div>
          </div>
        </div>
        <?php endwhile; ?>
      </div>
      <?php else : endif; ?>
    </div>
  </section>
</div>
