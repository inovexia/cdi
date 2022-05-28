<section class="home-product-categories">
  <div class="container">
    <div class="row">
      <!--<div class="col-6">
        <h6 class="subtitle-secondary text-uppercase">
          <?php echo the_field('product_section_sub_title'); ?>
        </h6>
        <h2 class="section-title text-white"><?php echo the_field("product_section_title"); ?></h2>
      </div>-->
      <div class="col-12">
          <h1>Browse medication</h1>
      </div>
    </div>

    <div class="brands">
      <div class="row">
        <div class="col-4 mt-5">
			<div class="box-product-categories">
          <h4 class="">Top Insulin Brands</h4>
          <ul class="list-disc mt-5 pl-6">
            <?php
            $terms =  array('taxonomy' => 'product_brand', 'hide_empty' => false,);
            $product_brand = get_terms($terms);
            foreach ($product_brand as $key => $brand) { ?>
            <li>
              <a href="<?php echo get_term_link($brand); ?>" class=""><?php echo $brand->name;  ?><!--<span> (<?php echo $brand->count; ?>)</span>--></a>
            </li>
            <?php } ?>
          </ul>
        </div>
        </div>
        <div class="col-4 mt-5">
			<div class="box-product-categories">
          <h4 class="">Top Diabetic Medications</h4>
          <!--<ul class="list-disc mt-5 pl-6">
            <?php
            $terms =  array('taxonomy' => 'product_brand', 'hide_empty' => false,);
            $product_brand = get_terms($terms);
            foreach ($product_brand as $key => $brand) { ?>
            <li>
              <a href="<?php echo get_term_link($brand); ?>" class=""><?php echo $brand->name;  ?><!--<span> (<?php echo $brand->count; ?>)</span>/a>
            </li>
            <?php } ?>
          </ul>-->
          <?php
            $args = array(
                'post_type' => 'product',
                'meta_key' => 'total_sales',
                'orderby' => 'meta_value_num',
                'posts_per_page' => 1,
            );
            $loop = new WP_Query( $args );
            while ( $loop->have_posts() ) : $loop->the_post();
            global $product; ?>
              <ul class="list-disc mt-5 pl-6">
                <li>
                  <a href="<?php the_permalink(); ?>" id="id-<?php the_id(); ?>" title="<?php the_title(); ?>">
                  <?php /*if (has_post_thumbnail( $loop->post->ID ))
                          echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog');
                          else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="product placeholder Image" width="65px" height="115px" />';*/ ?>
                  <?php the_title(); ?>
                  </a>
                </li>
              </ul>
          <?php endwhile; ?>
          <?php wp_reset_query(); ?>
			  </div>
      </div>
      <div class="col-4 mt-5">
    			<div class="box-product-categories">
                <h4 class="">Top Diabetic Supplies</h4>
                <!--<ul class="list-disc mt-5 pl-6">
                  <?php
                  $terms =  array('taxonomy' => 'product_brand', 'hide_empty' => false,);
                  $product_brand = get_terms($terms);
                  foreach ($product_brand as $key => $brand) { ?>
                  <li>
                    <a href="<?php echo get_term_link($brand); ?>" class=""><?php echo $brand->name;  ?><!--<span> (<?php echo $brand->count; ?>)</span></a>
                  </li>
                  <?php }  ?>
                </ul>-->
                <?php
                  $args = array(
                      'post_type' => 'product',
                      'taxonomy' => 'diabetic-supplies',
                      'meta_key' => 'total_sales',
                      'orderby' => 'meta_value_num',
                      'posts_per_page' => 1,
                  );
                  $loop = new WP_Query( $args );
                  while ( $loop->have_posts() ) : $loop->the_post();
                  global $product; ?>
                    <ul class="list-disc mt-5 pl-6">
                      <li>
                        <a href="<?php the_permalink(); ?>" id="id-<?php the_id(); ?>" title="<?php the_title(); ?>">
                        <?php /*if (has_post_thumbnail( $loop->post->ID ))
                                echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog');
                                else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="product placeholder Image" width="65px" height="115px" />';*/ ?>
                        <?php the_title(); ?>
                        </a>
                      </li>
                    </ul>
                <?php endwhile; ?>
                <?php wp_reset_query(); ?>
              </div>
          </div>
      </div>
    </div>

    <div class="row">
      <?php
        $category_name = ['insulin', 'hypoglycemic', 'diabetic-supplies'];
        $cats = invwp_get_product_categories ($category_name);
        if (! empty ($cats)) {
          foreach ($cats as $id => $cat) {
            ?>
            <div class="col-4 product-categories">
      				<div class="box-product-categories">
                      <h4 class="mb-5"><?php echo '<a href="'.$cat['link'].'">' . $cat['name'] . '</a>'; ?></h4>
                      <?php
                      if (! empty ($cat['sub_cats'])) {
                        echo '<ul class="list-disc pl-6">';
                        foreach ($cat['sub_cats'] as $sub_cat) {
                          echo '<li>';
                            echo '<a href="'.$sub_cat['link'].'">' . $sub_cat['name'] . '</a>';
                          echo '</li>';
                        }
                        echo '</ul>';
                      }
                      ?>
      				</div>
            </div>
            <?php
          }
        }
      ?>
    </div>

  </div>
</section>
