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
		<h4 class="">OUR PRODUCTS</h4>
		<ul class="list-unstyled">
			<li>
				<a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" class="lato-normal-black-pearl-14px">All Products <span> (<?php echo total_product_count();  ?>)</span></a>
			</li>
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
			<li>
				<a href="<?php echo get_term_link($category); ?>" class=""><?php echo $category->name; ?> <span> (<?php echo $category->count;  ?>)</span></a>
			</li>
			<?php
			}
			?>
		</ul>
	</div>

	<div class="brands ">
		<h4 class="">OUR BRANDS</h4>

		<ul class="list-unstyled">
			<?php
			$terms =  array('taxonomy' => 'product_brand', 'hide_empty' => false,);
			$product_brand = get_terms($terms);
			foreach ($product_brand as $key => $brand) { ?>
			<li>
				<a href="<?php echo get_term_link($brand); ?>" class=""><?php echo $brand->name;  ?><span> (<?php echo $brand->count; ?>)</span></a>
			</li>

			<?php }  ?>
		</ul>
	</div>
</aside>
