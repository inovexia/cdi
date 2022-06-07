<section class="home-faq-section">
    <div class="container">
        <h3 class="section-title text-center mb-5 pb-20">Frequently Asked Questions</h3>
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
                        <h6 class="accordion-title"><?php the_sub_field('accordion_title'); ?></h6>
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