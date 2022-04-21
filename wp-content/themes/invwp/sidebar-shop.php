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
	<div class="ourproduct-cat">
		<?php
			$cats = get_product_categories ();
			if (! empty ($cats)) {
				foreach ($cats as $id => $cat) {
					?>
					<div class="col-4 product-categories">
							<h4 class="mb-5"><?php echo '<a href="'.$cat['link'].'">' . $cat['name'] . '</a>'; ?></h4>
							<?php
							if (! empty ($cat['sub_cats'])) {
								echo '<ul class="list-disc pl-6">';
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
		<ul class="list-unstyled">
			<!--<li>
				<a href="<?php //echo get_permalink(wc_get_page_id('shop')); ?>" class="">All Products <span> (<?php //echo total_product_count();  ?>)</span></a>
			</li>-->
			<?php
				$cat_args = array(
					'orderby'    => 'name',
					'order'      => 'ASC',
					'hide_empty' => false,
				);
				$product_categories = get_terms('product_cat', $cat_args);
				foreach ($product_categories as $key => $category) {
					$size = 'full'; //can also be value: 'thumbnail'
					$thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
					$image = wp_get_attachment_image($thumbnail_id, $size);
			?>
			<li class="my-3">
				<a href="<?php echo get_term_link($category); ?>" class=""><?php echo $category->name; ?> <span> (<?php echo $category->count;  ?>)</span></a>
			</li>
			<?php
			}
			?>
		</ul>
	</div>

	<div class="brands">
		<ul class="list-unstyled">
			<?php
			$terms =  array('taxonomy' => 'product_brand', 'hide_empty' => false,);
			$product_brand = get_terms($terms);
			foreach ($product_brand as $key => $brand) { ?>
			<li>
				<a href="<?php echo get_term_link($brand); ?>" class=""><?php echo $brand->name;  ?><span> (<?php echo $brand->count; ?>)</span></a>
			</li>
			<?php } ?>
		</ul>
	</div>
</aside>
