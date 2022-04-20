<section class="home-faq-section section-padding">
  <div class="container">
    <h3 class="section-title">Frequently Asked Questions</h3>
    <?php if (have_rows('faq_collapse')) : ?>
    <div class="accordion accordion-container" id="accordion">
      <?php $y = 0;;
        while (have_rows('faq_collapse')) : the_row();
          $y++;
          $tCount = $y; ?>
      <div class="accordion-item">
        <h6 class="accordion-header article-title" id="toggle-btn" data-toggle="collapse" data-target="#toggle-example" aria-expanded="true"
          aria-controls="collapse<?php echo $tCount; ?>">
          <i></i><span class="accordion-button"><?php the_sub_field('accordion_title'); ?></span>
        </h6>
        <div id="toggle-example" class="accordion-collapse collapse accordion-content" aria-labelledby="heading<?php echo $tCount; ?>" data-bs-parent="#accordionExample">
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
