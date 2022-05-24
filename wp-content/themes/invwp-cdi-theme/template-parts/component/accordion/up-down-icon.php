<section class="faq-section">
  <div class="container body-container">
    <div class="row">
      <div class="col-12 d-flex justify-content-center">
        <h4><?php echo the_field('faq_title'); ?></h4>
      </div>
    </div>
	
    <!-- <div class="row section-margin-row">
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
    </div> -->
    <div class="row section-margin-row">
      <div class="col-12">
        <h3><?php the_field('accordian_title'); ?></h3>
        <?php if( have_rows('accordian') ): ?>
		<div class="accordion accordion-container" id="accordion">
			<?php $y = 0;
			while( have_rows('accordian') ): the_row(); 
			$y++;
            $tCount = $y; ?>
			<div class="accordion-item content-entry">
				<h4 class="accordion accordion-header article-title" id="toggle-btn" data-toggle="collapse" data-target="#toggle-example" aria-expanded="true"
            aria-controls="collapse<?php echo $tCount; ?>">
            <span class="accordion-button montserrat-normal-ebony-clay-12px"><?php the_sub_field('accordian_title'); ?></span>
				</h4>
				<div id="toggle-example" class="panel accordion-collapse collapse accordion-content" aria-labelledby="heading<?php echo $tCount; ?>" data-bs-parent="#accordionExample">
					<div class="accordion-body montserrat-normal-ebony-clay-12px">
					  <?php the_sub_field('accordian_content') ?>
					</div>
				</div>
			</div>	
				<?php endwhile; ?>
		</div>
        <?php endif; ?>
        
      </div>
    </div>

  </div>
</section>