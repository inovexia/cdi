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
<style>
.filteraccordion {
  width: 100%;
  max-width: 320px;
  margin: 30px auto 20px;
  background: var(--white);
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
}

.filteraccordion .filter-link {
  cursor: pointer;
  display: block;
  padding: 15px 15px 15px 0;
  color: var(--faux-cg-blue);
  font-size: 14px;
  font-weight: 700;
  position: relative;
  -webkit-transition: all 0.4s ease;
  -o-transition: all 0.4s ease;
  transition: all 0.4s ease;
}

.filteraccordion li:last-child .filter-link { border-bottom: 0; }

.filteraccordion .filter-link i {
  position: absolute;
  top: 16px;
  left: 12px;
  font-size: 18px;
  color: var(--faux-cg-blue);
  -webkit-transition: all 0.4s ease;
  -o-transition: all 0.4s ease;
  transition: all 0.4s ease;
}

.filteraccordion .filter-link i.fa-chevron-down {
  right: 12px;
  left: auto;
  font-size: 16px;
}

.filteraccordion .filter-open .filter-link { color: var(--faux-cg-blue) }

.filteraccordion .filter-open i { color: var(--faux-cg-blue); }

.filteraccordion .filter-open i.fa-chevron-down {
  -webkit-transform: rotate(180deg);
  -ms-transform: rotate(180deg);
  -o-transform: rotate(180deg);
  transform: rotate(180deg);
}

/**
 * filter-submenu
 -----------------------------*/
.filter-submenu {
  display: none;
  background: var(--white);
  font-size: 14px;
}

.filter-submenu li { }

.filter-submenu a {
  display: block;
  text-decoration: none;
  color: var(--faux-cg-blue);
  padding: 12px;
  padding-left: 42px;
  -webkit-transition: all 0.25s ease;
  -o-transition: all 0.25s ease;
  transition: all 0.25s ease;
}

.filter-submenu a:hover {
  background: var(--white);
  color: var(--faux-cg-blue);
}
</style>

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
			$cats = get_product_categories ();
			if (! empty ($cats)) {
				foreach ($cats as $id => $cat) {
					?>
					<div class="col-12 product-categories">
							<h4 class="mb-5 shoparticle-title1 filter-link" id="shoptoggle-btn1"><?php echo '<a href="'.$cat['link'].'">' . $cat['name'] . '</a>'; ?><i class="fa fa-chevron-down"></i></h4>
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
								<h4 class="mb-5 pl-6 shoparticle-title filter-link" id="shoptoggle-btn1"><?php echo '<a href="'.$cat['link'].'">' . $cat['name'] . '</a>'; ?><i class="fa fa-chevron-down"></i></h4>
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
