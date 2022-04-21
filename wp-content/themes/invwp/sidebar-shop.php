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
	<div class="ourproduct-cat shopaccordion-container" id="shopaccordion">
		<?php
			$cats = get_product_categories ();
			if (! empty ($cats)) {
				foreach ($cats as $id => $cat) {
					?>
					<div class="col-12 product-categories">
							<h4 class="mb-5 shoparticle-title" id="shoptoggle-btn"><i></i><?php echo '<a href="'.$cat['link'].'">' . $cat['name'] . '</a>'; ?></h4>
							<?php
							if (! empty ($cat['sub_cats'])) {
								echo '<ul id="shoptoggle-example" class="list-disc pl-10 accordion-content">';
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
</aside>
