<?php
/**
* Template Name: Product Brands
*
* @package WordPress
* @subpackage INV_WPinvwpsTARTER
* @since 2021
*/

//get_header ();

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );
?>

<div class="container">

	<div class="brands">
		<h2><?php the_title (); ?></h2>
		<div class="row my-5">
		  <?php
		  $terms =  array('taxonomy' => 'product_brand','hide_empty' => false,);
		  $product_brand = get_terms( $terms );
		  foreach ($product_brand as $key => $brand) {
			$thumbnail_id = get_term_meta( $brand->term_id, 'thumbnail_id', true );
			$image = wp_get_attachment_image( $thumbnail_id);
			?>

		  <div class="col-3">
			<div class="brands-prod-category">
			  <div class="product-img">
				 <div class="overlay-box"></div>
				 <a href="<?php echo get_term_link($brand); ?>" title="<?php echo $brand->name; ?>">
					<div class="cat-img"><?php echo $image; ?></div>
					<a href="<?php echo get_term_link($brand); ?>" class=""><?php echo $brand->name;  ?><span>(<?php echo $brand->count; ?>)</span></a>
				 </a>
			   </div>
			</div>
		  </div>

		  <?php }  ?>

			<!--<ul>
				<?php
				/*$terms =  array('taxonomy' => 'product_brand','hide_empty' => false,);
				$product_brand = get_terms( $terms );
				foreach ($product_brand as $key => $brand) { ?>

				<li>
					<a href="<?php echo get_term_link($brand); ?>" class=""><?php echo $brand->name;  ?><span>(<?php echo $brand->count; ?>)</span></a>
				</li>

				<?php }*/  ?>
			</ul>-->
		</div>
    </div>

	<p>
		<?php
			/**
			 * Hook: woocommerce_after_shop_loop.
			 *
			 * @hooked woocommerce_pagination - 10
			 */
			do_action( 'woocommerce_after_shop_loop' );
	 	?>
 	</p>

	<div class="clearfix"></div>

</div>

<?php
	/**
	* Hook: woocommerce_after_main_content.
	*
	* @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
	*/
	do_action( 'woocommerce_after_main_content' );

	get_footer();

?>
