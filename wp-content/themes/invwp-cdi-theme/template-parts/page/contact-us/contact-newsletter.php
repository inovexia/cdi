<section class="contact-newsletter-wrp">
    <div class="container">
        <div class="row">
            <div class="col-7">
                <div class="row">
                    <?php if( have_rows('contact_info') ): ?>
                    <?php while( have_rows('contact_info') ): the_row(); ?>
                    <div class="col-4">
                        <h4><?php the_sub_field('contact_heading'); ?></h4>
                        <p><a
                                href="<?php the_sub_field('contact_link'); ?>"><?php the_sub_field('contact_title'); ?></a>
                        </p>
                    </div>
                    <?php endwhile;
            endif; ?>
                </div>
            </div>
            <div class="col-5 news-letter-part">
                <h4><?php the_field('newsletter_heading'); ?></h4>
                <p><?php the_field('newsletter_paragraph'); ?></p>
                <?php dynamic_sidebar('top-footer-newsletter'); ?>
            </div>
        </div>
    </div>
</section>