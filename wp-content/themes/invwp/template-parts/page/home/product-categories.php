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
        <div class="home-product-category-slider">

            <?php
            $taxonomy = 'product_cat';
              // Get subcategories of the current category
              $terms    = get_terms([
                  'taxonomy'    => $taxonomy,
                  'hide_empty'  => true,
              ]);

              $output = '<ul class="subcategories-list">';

              // Loop through product subcategories WP_Term Objects
              foreach ( $terms as $term ) {
                  $term_link = get_term_link( $term, $taxonomy );

                  $output .= '<li class="'. $term->slug .'"><a href="'. $term_link .'">'. $term->name .'</a></li>';
              }

              echo $output . '</ul>';

             $args = array(
              'orderby'    => 'name',
              'order'      => 'ASC',
              'hide_empty' => false,
             );
             $product_categories = get_terms( 'product_cat', $cat_args);
             if ($product_categories) {
               foreach ($product_categories as $key => $category) {
               //print_r($category);
                 ?>
                 <div class="title">
                   <a class="text-uppercase" href="<?php echo get_term_link($category); ?>" title="<?php echo $category->name; ?>"><?php echo $category->name; ?></a>
                 </div>
                 <?php
               }
             }
             ?>
        </div>

      </div>
    </div>

  </div>
</section>
