<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Inovexia_WP_Theme
 */

/*
if ( ! is_active_sidebar( 'sidebar-shop' ) ) {
	return;
}
*/
?>

<aside class="sidebar-left widget-area">

	<?php //dynamic_sidebar( 'sidebar-shop' ); ?>
	<div class="row ">
		<?php
			$cats = get_product_categories ();
			if (! empty ($cats)) {
				foreach ($cats as $id => $cat) {
					?>
					<div class="col-12 ourproduct-cat accordion">
							<h4 class="mb-1 accordion-title filter-link">
								<?php echo '<a href="'.$cat['link'].'">' . $cat['name'] . '</a>'; ?>
							</h4>
							<?php
							if (! empty ($cat['sub_cats'])) {
								?>
								<div class="accordion-content">
									<ul class="list-disc pl-10 --filter-submenu">
										<?php
										foreach ($cat['sub_cats'] as $sub_cat) {
											echo '<li>';
												echo '<a href="'.$sub_cat['link'].'">' . $sub_cat['name'] . ' ('.$sub_cat['count'].')</a>';
											echo '</li>';
										}
										?>
									</ul>
								</div>
								<?php
							}
							?>
					</div>
					<?php
				}
			}
		?>
	</div>

	<div class="ourproduct-shopfilter filteraccordion" id="filter-accordion">
		<p class="shopfilter"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/cil_filter.png" />&nbsp; Filter By</p>
		<nav class="shopfilter-slide">
			<p class="shopfilterclose">>&nbsp;&nbsp; Filter By</p>
			<?php
				$cats = get_product_categories ();
				if (! empty ($cats)) {
					foreach ($cats as $id => $cat) {
						?>
						<div class="col-12 product-categories">
								<h4 class="mb-1 pl-6 shoparticle-title filter-link" id="shoptoggle-btn1"><?php echo '<a href="'.$cat['link'].'">' . $cat['name'] . '</a>'; ?><i class="fa fa-chevron-down"></i></h4>
								<?php
								if (! empty ($cat['sub_cats'])) {
									echo '<ul id="shoptoggle-example1" class="list-disc pl-10 accordion-content filter-submenu">';
									foreach ($cat['sub_cats'] as $sub_cat) {
										echo '<li>';
											echo '<a href="'.$sub_cat['link'].'">' . $sub_cat['name'] . '</a>';
										echo '</li>';
									}
									echo '</ul>';
								}
								?>
						</div>
						<?php
					}
				}
			?>
		</nav>
	</div>

</aside>
