<section class="faq-section section-padding section-margin">
  <div class="container body-container">
    <div class="row">
      <div class="col-12 d-flex justify-content-center">
        <h2 class="main-heading"><?php echo the_field('faq_title'); ?></h2>
      </div>
    </div>
    <div class="row section-margin-row">
      <div class="col-12 col-md-8 mx-auto">
        <div class="accordion" id="accordionFlushExample">
          <?php if( have_rows('faq_collapse') ): ?>
          <?php $j=1; while( have_rows('faq_collapse') ): the_row(); ?>
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne<?php echo $j;?>" data="<?php echo $j;?>">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne<?php echo $j;?>" aria-expanded="false"
                aria-controls="flush-collapseOne">
                <?php the_sub_field('accordion_title'); ?>
              </button>
            </h2>
            <div id="flush-collapseOne<?php echo $j;?>" class=" collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample<?php echo $j;?>">
              <div class="accordion-body "><?php the_sub_field('accordion_description'); ?></div>
            </div>
          </div>
          <?php $j++; endwhile;
                     endif; ?>
        </div>
      </div>
    </div>

  </div>
</section>