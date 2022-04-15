<section class="home-faq-section">
  <div class="container">
    <h3 class="section-title">Frequently Asked Questions</h3>
    <?php if (have_rows('faq_collapse')) : ?>
    <div class="accordion " id="accordionExample">
      <?php $y = 0;;
        while (have_rows('faq_collapse')) : the_row();
          $y++;
          $tCount = $y; ?>
      <div class="accordion-item">
        <h6 class="accordion-header" id="heading<?php echo $tCount; ?>" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $tCount; ?>" aria-expanded="true"
          aria-controls="collapse<?php echo $tCount; ?>">
          <span class="accordion-button"><?php the_sub_field('accordion_title'); ?></span>
        </h6>
        <div id="collapse<?php echo $tCount; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $tCount; ?>" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <p><?php the_sub_field('accordion_description'); ?></p>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
    <?php else : endif; ?>
  </div>
</section>
