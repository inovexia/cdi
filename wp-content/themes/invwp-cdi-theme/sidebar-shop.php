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
		<div class="col-12">
			<p class="shopfilterclose">Filter By</p>
			<div class="collapse">
				<?php
					$cats = invwp_get_product_categories ();
					if (! empty ($cats)) {
						foreach ($cats as $id => $cat) {
							?>
							 <div class="collapse-item">
								 	<p class="collapsible">
								 		<?php echo '<a href="'.$cat['link'].'">' . $cat['name'] . '</a>'; ?>
									</p>
								 	<div class="content">
										<ul>
										<?php
										if (! empty ($cat['sub_cats'])) {
											foreach ($cat['sub_cats'] as $sub_cat) {
												echo '<li>';
													echo '<a href="'.$sub_cat['link'].'">' . $sub_cat['name'] . ' ('.$sub_cat['count'].')</a>';
												echo '</li>';
											}
										}
										?>
										</ul>
								 </div>
							 </div>
							 <?php
						 }
					 }
					?>
				</div>
			</div>
	</div>
</aside>
