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
          <h1>Browse Medications</h1>
      </div>
    </div>

    <div class="brands">
      <div class="row">
        <div class="col-4">
          <h4 class="">Top Insulin Brands</h4>
          <?php
          $terms =  array('taxonomy' => 'product_brand', 'hide_empty' => false,);
          $product_brand = get_terms($terms);
          foreach ($product_brand as $key => $brand) { ?>
          <li>
            <a href="<?php echo get_term_link($brand); ?>" class=""><?php echo $brand->name;  ?><!--<span> (<?php echo $brand->count; ?>)</span>--></a>
          </li>

          <?php }  ?>
        </div>
        <div class="col-4">
          <h4 class="">Top Diabetic Medications</h4>
          <?php
          $terms =  array('taxonomy' => 'product_brand', 'hide_empty' => false,);
          $product_brand = get_terms($terms);
          foreach ($product_brand as $key => $brand) { ?>
          <li>
            <a href="<?php echo get_term_link($brand); ?>" class=""><?php echo $brand->name;  ?><!--<span> (<?php echo $brand->count; ?>)</span>--></a>
          </li>

          <?php }  ?>
        </div>
          <div class="col-4">
            <h4 class="">Top Diabetic Supplies</h4>
            <ul class="list-disc my-6 pl-6">
              <?php
              $terms =  array('taxonomy' => 'product_brand', 'hide_empty' => false,);
              $product_brand = get_terms($terms);
              foreach ($product_brand as $key => $brand) { ?>
              <li>
                <a href="<?php echo get_term_link($brand); ?>" class=""><?php echo $brand->name;  ?><!--<span> (<?php echo $brand->count; ?>)</span>--></a>
              </li>
              <?php }  ?>
            </ul>
          </div>
      </div>
    </div>

    <div class="row">
      <?php
        $cats = get_product_categories ();
        if (! empty ($cats)) {
          foreach ($cats as $id => $cat) {
            ?>
            <div class="col-4 product-categories">
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
            <?php
          }
        }
      ?>
    </div>

  </div>
</section>
