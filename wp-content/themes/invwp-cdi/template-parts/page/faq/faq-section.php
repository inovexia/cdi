<section class="faq-section section-padding">
  <div class="container">
    <?php if (have_rows('accordian')) : ?>
      <div class="collapse">
        <?php
          $y = 0;
          while (have_rows('accordian')) :
            the_row();
            $y++;
            $tCount = $y;
            ?>
            <div class="collapse-item">
              <h4 class="collapsible" id="heading<?php echo $tCount; ?>" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $tCount; ?>" aria-expanded="true"
                aria-controls="collapse<?php echo $tCount; ?>">
                <?php the_sub_field('accordian_title'); ?>
              </h4>
              <div class="content" aria-labelledby="heading<?php echo $tCount; ?>" data-bs-parent="">
                  <?php the_sub_field('accordian_content'); ?>
              </div>
            </div>
        <?php endwhile; ?>
      </div>
      <?php else : endif; ?>
    </div>
  </section>
