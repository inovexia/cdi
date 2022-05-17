<div class="row ">
  <div class="col-12 ">
    <h4 class="product-innertitle montserrat-semi-bold-ebony-clay-18px text-uppercase">Frequently Asked Questions</h4>

    <div class="accordion accordion accordion-flush" id="accordionPanelsStayFAQ">
      <?php
        if( have_rows('product_faq_collapse') ):
          $i = 0; ;
          while ( have_rows('product_faq_collapse') ) :
            the_row();
            $i++;
            $tCount = $i;
            ?>
      <div class="accordion-item">
        <h2 class="accordion-header montserrat-normal-ebony-clay-12px" id="panelsStayOpen-heading<?php echo $tCount; ?>">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-<?php echo $tCount; ?>" aria-expanded="false"
            aria-controls="panelsStayOpen-<?php echo $tCount; ?>">
            <?php the_sub_field('product_accordion_title'); ?>
          </button>
        </h2>
        <div id="panelsStayOpen-<?php echo $tCount; ?>" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading<?php echo $tCount; ?>" data-bs-parent="#accordionPanelsStayFAQ">
          <div class="accordion-body montserrat-normal-ebony-clay-12px">
            <?php the_sub_field('product_accordion_description'); ?>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
      <?php else : ?>
      <div class="card-review">
        <div class="card-body">
          <p class="card-title review-title float-left montserrat-normal-ebony-clay-12px"> This product has no FAQs yet. </p>
        </div>
      </div>
      <?php endif; ?>
    </div>

  </div>
</div>
<!--faq row end-->