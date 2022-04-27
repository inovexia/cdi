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

<!-- Contenedor
<div id="filter-accordion" class="filteraccordion">
  <div class="col-12 product-categories">
    <h4 class="filter-link">Cat 1<i class="fa fa-chevron-down"></i></h4>
    <ul class="filter-submenu">
      <li><a href="#">Subcat 1</a></li>
      <li><a href="#">Subcat 2</a></li>
      <li><a href="#">Subcat 3</a></li>
    </ul>
  </div>
</div>-->


	<?php //dynamic_sidebar( 'sidebar-shop' ); ?>
	<div class="ourproduct-cat shopaccordion-container filteraccordion" id="filter-accordion">
		<?php
			$cat_args = array(
                    'orderby'    => 'name',
                    'order'      => 'ASC',
                    'hide_empty' => false,
                  );
			$product_categories = get_terms('product_cat', $cat_args);
			//print_r($product_categories);
			foreach ($product_categories as $key => $category) {
			?>
			<!--<li>
			  <a href="<?php echo get_term_link($category); ?>"><?php echo $category->name;  ?><span>(<?php echo $category->count;  ?>)</span></a>
			</li>-->
			<?php
			}
			//$pcat_args =  array('taxonomy' => 'product_cat', 'hide_empty' => false,);
            //$Countcats = get_terms($pcat_args);
			$cats = get_product_categories ();
			if (! empty ($cats)) {
				foreach ($cats as $id => $cat) {
					?>
					<div class="col-12 product-categories">
							<h4 class="mb-1 shoparticle-title1 filter-link" id="shoptoggle-btn1"><?php echo '<a href="'.$cat['link'].'">' . $cat['name'] . '</a>'; ?><i class="fa fa-chevron-down"></i></h4>
							<?php
							if (! empty ($cat['sub_cats'])) {
								echo '<ul id="shoptoggle-example1" class="list-disc pl-10 accordion-content filter-submenu">';
								foreach ($cat['sub_cats'] as $sub_cat) {
									echo '<li>';
										echo '<a href="'.$sub_cat['link'].'">' . $sub_cat['name'] . ' ('.$sub_cat['count'].')</a>';
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
