<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Medical_Depot_Theme
 */

get_header();
global $woocommerce;
global $product;
?>

<main id="primary" class="site-main search-sections pt-5 pb-3">

    <?php //if ( have_posts() ) : ?>

    <!--<header class="page-header">
				<h1 class="page-title">
					<?php
					/* translators: %s: search query. */
					//printf( esc_html__( 'Search Results for: %s', 'mdt' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
			</header> .page-header -->

    <?php
			/*if ( have_posts() ) :
			/* Start the Loop
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.

				get_template_part( 'template-parts/content', 'search' );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;*/
		?>

    <div id="content" role="main">
        <div class="container">
            <div class="search-result-content">
                <?php
if ( have_posts() ) {
	?>
                <div class="row search-result-row pb-5">

                    <!--<div class="search-result-count default-max-width">
		<?php
		/*printf(
			esc_html(
				/* translators: %d: The number of search results.
				_n(
					'We found %d result for your search.',
					'We found %d results for your search.',
					(int) $wp_query->found_posts,
					'in-a-flashdev-new'
				)
			),
			(int) $wp_query->found_posts
		);*/
		?>
	</div> .search-result-count -->
                    <?php
	// Start the Loop.
	while ( have_posts() ) {
		the_post();

		if ( get_post_type() == 'post' ) { //for posts		?>

                    <div id="post-<?php the_ID(); ?>" class="card1 col-3 post-column search-result-card post-search">
                        <div class="card-body">

                        </div>
                        <?php
						if ( has_post_thumbnail() ) :
							the_post_thumbnail();
						endif;
					?>
                        <div class="card-body">
                            <h5 class="card-title"> <?php
						$name = get_the_title();;
						if (strlen($name) > 50){
							echo substr($name, 0, 45) . '...';
						}
						else{
							echo $name;
						}
						
						?></h5>
                            <a href="<?php the_permalink(); ?>" class="float-left card-link read-more"><span></span>Read
                                More</a>
                        </div>
                    </div>
                    <?php
						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						//get_template_part( 'content-search' );

						} else { //for products  ?>

                    <div id="post-<?php the_ID(); ?>" class="card1 post-column search-result-card product-search">
                        <div class="image-container cat-image position-relative hover-effect">
                            <div class="product-image">
                                <?php
									if ( has_post_thumbnail() ) :
										the_post_thumbnail();
									endif;
								?>
                            </div>
                            <div class="over-lay">
                                <div class="footer-pdt">
                                    <?php
										$prc_html = $product->get_price_html();
										$currency_name = get_woocommerce_currency();
									 ?>
                                    <div class="discount-prc">
                                        <a class="card-title"
                                            href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a>
                                        <div class="buttons">
                                            <a href="?add-to-cart=<?php echo the_ID(); ?>" data-quantity="1"
                                                class="button button-primary text-uppercase add_to_cart_button ajax_add_to_cart w-100 mt-2 text-decoration-none text-center"
                                                data-product_id="<?php echo the_ID(); ?>"
                                                data-product_sku="<?php echo $product->get_sku(); ?>"
                                                aria-label="Add <?php echo the_title(); ?>" rel="nofollow">Add to
                                                cart</a>
                                        </div>
                                        <p class="product-price">
                                            <?php echo $product->get_price_html(); ?>
                                        </p>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <?php
			} //end for products

				} // End the loop.

				// Previous/next page navigation.
				// twenty_twenty_one_the_posts_navigation();

				// If no content, include the "No posts found" template.
			} else {
				get_template_part( 'template-parts/content-none' );
			}
		?>
                </div>

            </div>
        </div>
    </div><!-- #content -->

</main><!-- #main -->

<?php
//get_sidebar();
get_footer();