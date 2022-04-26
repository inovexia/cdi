<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
	<div class="contents">
		<div class="row">
			<div class="col-3 filter-singleshop">
				<?php get_sidebar('shop'); ?>
			</div>
			<div class="col-9">
				<div class="row">
					<div class="col-6">
						<?php
						/**
						 * Hook: woocommerce_before_single_product_summary.
						 *
						 * @hooked woocommerce_show_product_sale_flash - 10
						 * @hooked woocommerce_show_product_images - 20
						 */
						//do_action( 'woocommerce_before_single_product_summary' );
						?>
						<div id="simpleModal" class="modal">
							<div class="modal-content">
								<span class="closeBtn">&times;</span>
								<!-- Swiper modal -->
								<div id="swiper-container-modal" class="swiper-container-modal">
								<div class="swiper-wrapper">

								<?php //while ( have_posts() ) :
										//the_post();
									$attachment_idssm = $product->get_gallery_image_ids();
								?>
								<?php foreach( $attachment_idssm as $attachment_idnnm ) { ?>

									<div class="swiper-slide swiper-slide-modal">
										<div class="swiper-zoom-container">
											<img class="swiper-lazy swiper-lazy-modal" data-src="<?php echo $image_linknn = wp_get_attachment_url( $attachment_idnnm ); ?>" alt="">
										</div>
									</div>
								<?php  } ?>
								<?php //endwhile; // end of the loop. ?>

								</div>

								</div><div class="navigate-btn">
									<div class="swiper-button-next"></div>
									<div class="swiper-button-prev"></div>
									</div>
							</div>
						</div>

						<!-- Swiper -->
						<div class="swiper swiper-container ml-0 swiper-containernew swiper-container-main">
						<div class="swiper-wrapper">
						<?php //while ( have_posts() ) :
							//the_post();
						$attachment_idsNew = $product->get_gallery_image_ids();
						$featured_image = wp_get_attachment_url( get_post_thumbnail_id(get_the_Id()) );
						?>

						<?php
						if( $attachment_idsNew ){
							 foreach($attachment_idsNew as $attachment_idNew){
						?>
						<div class="swiper-slide minimum-height">
							<img class="swiper-slide-img" src="<?php echo $image_link = wp_get_attachment_url( $attachment_idNew ); ?>">
							</div>
						<?php
						}
						}

						else{ ?>
							<div class="swiper-slide minimum-height">
							<img class="swiper-slide-img" src="<?php echo $featured_image; ?>">
							</div>
							<?php
						} ?>
						<?php //endwhile; // end of the loop. ?>

						</div>

						</div>


					<!-- Swiper thumbnails -->
					<div class="swiper swiper-container ml-0 swiper-containernew gallery-thumbs">
						<div class="swiper-wrapper">

							<?php //while ( have_posts() ) :
							//	the_post();
								$attachment_idsNew = $product->get_gallery_image_ids();
							?>
							<?php foreach( $attachment_idsNew as $attachment_idNew ) { ?>

								<div class="swiper-slide swiper-slide-thumbs">
									<img src="<?php echo $image_link = wp_get_attachment_url( $attachment_idNew ); ?>">
								</div>
							<?php  } ?>
							<?php //endwhile; // end of the loop. ?>

						</div>
					</div>

					<script type="text/javascript">
						<!-- Initialize Swiper -->


					</script>

					<style>
					/* ................................................ swiper gallery .......................................................... */
					#simpleModal .navigate-btn .swiper-button-prev{
							left: 30px;
					}
					 #simpleModal .navigate-btn .swiper-button-next{
							right: 30px;
					}
					.swiper-containernew {
						width: 500px;
						min-width: 300px;
						height: auto;
						padding-bottom: 15px;
					}

					.swiper-containernew .swiper-slide-img {
						height: auto;
						width: 100%;
						min-height: 353px;
					}

					.swiper-containernew .swiper-slide-img:hover {
						cursor: pointer;
					}
					/* ................................................ thumbs .......................................................... */

					.gallery-thumbs {
							padding: 0;
							margin-top: 0;
							margin-bottom: 40px;
					}

					.gallery-thumbs .swiper-slide {
							width: 25%;
							opacity: 0.9;
					}

					.gallery-thumbs .swiper-slide-thumb-active {
							opacity: 1;
					}

					.gallery-thumbs .swiper-slide img {
							width: 100%;
							height: 70px;
							min-height: 40px;
							object-fit: cover;
					}

					/* ................................................ modal .......................................................... */

					#simpleModal .modal-content {
						background-color: rgba(0, 0, 0,0.8);
						animation-name: modalOpen;
						animation-duration: 1s;
					}

					/* ............................................. modal swiper gallery ....................................................... */
					/* used ids higher specificity to override gallery styles */

					#swiper-container-modal {
						z-index:3;
						width:100%;
						height:100%;
						overflow:hidden;
						padding:0;
						border:0;
					}

					#swiper-pagination-modal {
						display:none; /* if pagination not included in modal... index.html pagination buttons dnt change (black for active slide)*/
					}

					#swiper-button-next-modal {
						transform:translateX(-40%);
						color: white;
					}

					#swiper-button-prev-modal {
						transform:translateX(40%);
						color: white;
					}

					.swiper-slide-modal {
						height: 100vh;
					}

					.swiper-lazy-modal {
						object-fit: contain;
						border:0;
					}
					/* ............................................. responsiveness ....................................................... */
					@media all and (max-width: 520px) {

						.abouttestimonialSwiper .navigate-btn {
								bottom: 15px !important;
						}
						.swiper-container {
							width: calc(100vw - 20px);
						}

						.swiper-button-next:after {
							font-size: 20px !important;
							transform:translateX(60%);
						}

						.swiper-button-prev:after {
							font-size: 20px !important;
							transform:translateX(-60%);
						}

						#swiper-button-next-modal {
							font-size: 20px !important;
							transform:translateX(20%);
						}

						#swiper-button-prev-modal {
							font-size: 20px !important;
							transform:translateX(-20%);
						}

						.swiper-pagination {
							padding: 4px;
						}

						.swiper-slide-img {
							width: calc(100vw-32px);
							height: auto;
							border: 16px solid #d8d8d8;  /* move next and prev buttons off img */
							min-height: calc((0.5338 * 100vw) + 48.476px);
						}

						.swiper-pagination .swiper-pagination-bullet {
							height: 12px;
							width: 12px;
						}

						.gallery-thumbs .swiper-slide img {
									height: 14vw;
						}
					}

					</style>
					</div>

					<div class="col-6 singleproduct-rightsidebar">

						<div class="summary entry-summary">
							<?php
							/**
							 * Hook: woocommerce_single_product_summary.
							 *
							 * @hooked woocommerce_template_single_title - 5
							 * @hooked woocommerce_template_single_rating - 10
							 * @hooked woocommerce_template_single_price - 10
							 * @hooked woocommerce_template_single_excerpt - 20
							 * @hooked woocommerce_template_single_add_to_cart - 30
							 * @hooked woocommerce_template_single_meta - 40
							 * @hooked woocommerce_template_single_sharing - 50
							 * @hooked WC_Structured_Data::generate_product_data() - 60
							 */
							do_action( 'woocommerce_single_product_summary' );
							?>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-12">

						<?php
						/**
						 * Hook: woocommerce_after_single_product_summary.
						 *
						 * @hooked woocommerce_output_product_data_tabs - 10
						 * @hooked woocommerce_upsell_display - 15
						 * @hooked woocommerce_output_related_products - 20
						 */
						do_action( 'woocommerce_after_single_product_summary' );
						?>
					</div>
					
					<?php do_action( 'woocommerce_after_single_product' ); ?>
					
				</div>
	
		</div><!--End main col-8-->
		
	  </div><!--End main row-->
	
   </div><!--End main section contain-->

</div>

