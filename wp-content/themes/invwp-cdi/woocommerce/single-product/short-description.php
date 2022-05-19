<?php
/**
 * Single product short description
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/short-description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post;

$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );

if ( ! $short_description ) {
	return;
}

global $product;
$product_cats_ids = wc_get_product_term_ids( $product->get_id(), 'product_cat' );
foreach( $product_cats_ids as $cat_id ) {
    $term = get_term_by( 'id', $cat_id, 'product_cat' );
    //print_r($term);
    $wc_options = get_option('woocommerce_permalinks');
 $product_category_base = $wc_options['category_base'];
?>
    <h4 class="single-product-cat-title"><a href="<?php echo site_url()."/".$product_category_base."/".$term->slug; ?>"><?php echo $term->name; ?></a></h4>
<?php 
}
?>
<div class="woocommerce-short-description-wrap my-5">
    <h2 class="woocommerce-short-desc-title">Description</h2>
    <div class="woocommerce-product-details__short-description my-5">
      <?php echo $short_description; // WPCS: XSS ok. ?>
    </div>
</div>
