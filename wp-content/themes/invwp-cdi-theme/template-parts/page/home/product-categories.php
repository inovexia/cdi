<section class="home-product-categories">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h6 class="subtitle-secondary text-uppercase">
                    <?php echo the_field('product_section_sub_title'); ?>
                </h6>
                <h2 class="section-title text-white"><?php echo the_field("product_section_title"); ?></h2>
            </div>

        </div>

        <div class="row">
          <div class="col-12">
            <!-- Slider main container -->
            <div class="home-product-category-slider swiper">
              <!-- Additional required wrapper -->
              <div class="swiper-wrapper">
                 <?php
                 $cat_args = array(
                  'orderby'    => 'name',
                  'order'      => 'ASC',
                  'hide_empty' => true,
                 );
                 $product_categories = get_terms( 'product_cat', $cat_args);
                 if ($product_categories) {
                   foreach ($product_categories as $key => $category) {
                     $thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
                     // get the image URL
                     $image = wp_get_attachment_url( $thumbnail_id );
                     ?>
                      <!-- Slides -->
                        <div class="swiper-slide">
                            <div class="slide-image">
                                <img src="<?php echo $image; ?>" alt="<?php echo $category->name; ?>" width='314'
                                    height='471' />
                            </div>
                            <div class="slide-title">
                                <a class="text-uppercase text-white" href="<?php echo get_term_link($category); ?>"
                                    title="<?php echo $category->name; ?>"><?php echo $category->name; ?></a>
                            </div>
                        </div>
                        <?php
                     }
                   }
                   wp_reset_query();
                   ?>
                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>
                <div class="swiper-arrow">
                  <div class="swiper-button-prev"></div>
                  <div class="swiper-button-next"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
            <div class="col-12">

            </div>
        </div>

    </div>
</section>
