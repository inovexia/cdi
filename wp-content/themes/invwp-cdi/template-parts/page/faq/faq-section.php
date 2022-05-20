<section class="faq-section section-margin">
	 <div class="container">
		<h3 class="section-title text-center mb-5 pb-20">Frequently Asked Questions</h3>
		<?php if (have_rows('faq_collapse')) : ?>
		  <div class="accordion" >
			<?php
			$y = 0;;
			while (have_rows('faq_collapse')) : the_row();
			  $y++;
			  $tCount = $y;
			  ?>
			  <div class="content-entry">
				<h6 class="accordion-title" >
				  <?php the_sub_field('accordion_title'); ?>
				</h6>
				<div class="accordion-content" >
					<p><?php the_sub_field('accordion_description'); ?></p>
				</div>
			  </div>
			<?php endwhile; ?>
		  </div>
		<?php else : endif; ?>
	  </div>
 </section>
