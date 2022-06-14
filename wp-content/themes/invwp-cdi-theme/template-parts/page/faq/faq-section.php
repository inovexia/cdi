<section class="home-faq-section section-padding section-margin">
    <div class="container">
        <!-- <h2 class="section-title text-center mb-5 pb-20">Frequently Asked Questions</h2> -->
        <?php if (have_rows('faq_collapse')) : ?>
        <div class="accordion">
            <?php
        $y = 0;;
        while (have_rows('faq_collapse')) : the_row();
          $y++;
          $tCount = $y;
          ?>
            <div class="accordion">
                <div class="group">
                    <a href="javascript:void(0);">
                        <p class="accordion-title"><?php the_sub_field('accordion_title'); ?></p>
                    </a>
                    <p class="body-part accordion-content"><?php the_sub_field('accordion_description'); ?></p>
                    </a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <?php else : endif; ?>
    </div>
</section>