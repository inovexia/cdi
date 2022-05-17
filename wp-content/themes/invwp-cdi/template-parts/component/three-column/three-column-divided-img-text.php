<section class="three-column-img-text-wrp">
	<div class="container">
		<div class="row">
			<?php if( have_rows('three_column') ): ?>
            <?php while( have_rows('three_column') ): the_row(); ?>
			<div class="col-4">
				<div class="three-column">
					<div class="three-column-image">
						<?php $three_column_image = get_field('three_column_image'); ?>
                		<img src="<?php echo $three_column_image['url'];?>" class="img-fluid" alt="30 Years Experience">
					</div>
					<div>
						<h4 class="subtitle-primary mb-5"><?php echo the_sub_field('three_column_heading'); ?></h4>
						<p class="mb-5"><?php echo the_sub_field('three_column_paragraph'); ?></p>
						<a href="#"><?php echo the_sub_field('three_column_button'); ?></a>
					</div>
				</div>
			</div>
			<?php endwhile;
                     endif; ?>
			<!-- <div class="col-4">
				<div class="three-column">
					<div class="three-column-image">
						<img src="<?php echo get_template_directory_uri(); ?>/images/glasses-eye-chart-white-background.png" />
					</div>
					<div>
						<h4 class="subtitle-primary mb-5">Featured title</h4>
						<p class="mb-5">Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
						<a href="#">Read More</a>
					</div>
				</div>
			</div>
			<div class="col-4">
				<div class="three-column">
					<div class="three-column-image">
						<img src="<?php echo get_template_directory_uri(); ?>/images/glasses-eye-chart-white-background.png" />
					</div>
					<div>
						<h4 class="subtitle-primary mb-5">Featured title</h4>
						<p class="mb-5">Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
						<a href="#">Read More</a>
					</div>
				</div>
			</div> -->
		</div>
	</div>
</section>