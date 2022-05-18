<?php
/**
* Template Name: Sitemap Page
*
* @package WordPress
* @subpackage Inovexia_Ecomm_Theme
* @since 2021
*/

get_header();
?>

<main id="primary" class="site-main">

    <?php
    $sidebar = get_field('sidebar', 'option');

      if($sidebar == 1 || $sidebar == 3){
        get_sidebar('left');
      }
    ?>

      <div class="content">

        <section class="section-privacyfullwidth sitemap-wrp">
          <div class="container">
            <div class="row">
              <div class="col-3">
                <?php
        							//get_sidebar();
        							if(is_active_sidebar('sitemap-col-1')){
        								dynamic_sidebar('sitemap-col-1');
        							}
        							?>
        		  <h3>SITEMAP-1</h3>
        		  <ul class="cat-menu">
                                    <?php
                                    $cat_args = array(
                                      'orderby'    => 'name',
                                      'order'      => 'ASC',
                                      'hide_empty' => false,
                                    );
                                    $product_categories = get_terms('product_cat', $cat_args);
                                    foreach ($product_categories as $key => $category) {
                                      $size = 'full'; //can also be value: 'thumbnail'
                                      $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                                      $image = wp_get_attachment_image($thumbnail_id, $size);
                                    ?>
                                    <li>
                                      <a href="<?php echo get_term_link($category); ?>"><?php echo $category->name;  ?></a>
                                    </li>
                                    <?php }  ?>
                                  </ul>
              </div>
              <div class="col-3">
                <?php
        							//get_sidebar();
        							if(is_active_sidebar('sitemap-col-2')){
        								dynamic_sidebar('sitemap-col-2');
        							}
        							?>
        		  <h3>SITEMAP-2</h3>
        		  <ul class="cat-menu">
                                    <?php
                                    $cat_args = array(
                                      'orderby'    => 'name',
                                      'order'      => 'ASC',
                                      'hide_empty' => false,
                                    );
                                    $product_categories = get_terms('product_cat', $cat_args);
                                    foreach ($product_categories as $key => $category) {
                                      $size = 'full'; //can also be value: 'thumbnail'
                                      $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                                      $image = wp_get_attachment_image($thumbnail_id, $size);
                                    ?>
                                    <li>
                                      <a href="<?php echo get_term_link($category); ?>"><?php echo $category->name;  ?></a>
                                    </li>
                                    <?php }  ?>
                                  </ul>
              </div>
              <div class="col-3">
                <?php
        							//get_sidebar();
        							if(is_active_sidebar('sitemap-col-3')){
        								dynamic_sidebar('sitemap-col-3');
        							}
        							?>
        		  <h3>SITEMAP-3</h3>
        		  <ul class="cat-menu">
                                    <?php
                                    $cat_args = array(
                                      'orderby'    => 'name',
                                      'order'      => 'ASC',
                                      'hide_empty' => false,
                                    );
                                    $product_categories = get_terms('product_cat', $cat_args);
                                    foreach ($product_categories as $key => $category) {
                                      $size = 'full'; //can also be value: 'thumbnail'
                                      $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                                      $image = wp_get_attachment_image($thumbnail_id, $size);
                                    ?>
                                    <li>
                                      <a href="<?php echo get_term_link($category); ?>"><?php echo $category->name;  ?></a>
                                    </li>
                                    <?php }  ?>
                                  </ul>
              </div>
              <div class="col-3">
                <?php
        							//get_sidebar();
        							if(is_active_sidebar('sitemap-col-4')){
        								dynamic_sidebar('sitemap-col-4');
        							}
        							?>
        		  <h3>SITEMAP-4</h3>
        		  <ul class="cat-menu">
                                    <?php
                                    $cat_args = array(
                                      'orderby'    => 'name',
                                      'order'      => 'ASC',
                                      'hide_empty' => false,
                                    );
                                    $product_categories = get_terms('product_cat', $cat_args);
                                    foreach ($product_categories as $key => $category) {
                                      $size = 'full'; //can also be value: 'thumbnail'
                                      $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                                      $image = wp_get_attachment_image($thumbnail_id, $size);
                                    ?>
                                    <li>
                                      <a href="<?php echo get_term_link($category); ?>"><?php echo $category->name;  ?></a>
                                    </li>
                                    <?php }  ?>
                                  </ul>
              </div>
            </div>
          </div>

        </section>


      </div>

      <?php
            if($sidebar == 2 || $sidebar == 3){
              get_sidebar('right');
            }
      ?>

</main><!-- #main -->
<?php get_footer(); ?>
