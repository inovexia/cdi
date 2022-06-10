<section class="home-product-categories">
  <div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Browse medication</h1>
        </div>
    </div>

    <div class="brands">

      <div class="row">
        <div class="col-4 mt-5">
    			<div class="box-product-categories">
              <h6 class="">Top Insulin Brands</h6>
              <ul class="list-disc mt-5 pl-6">
                <?php
                $args = array(
                       'taxonomy' => 'product_cat',
                       'hide_empty' => true,
                       'parent'   => 18,
                     );
                $i = 1;
                $top_insulin_brands = get_terms($args);
                foreach ($top_insulin_brands as $key => $brand) {
                  ?>
                  <li>
                    <a href="<?php echo get_term_link($brand->term_id); ?>" class=""><?php echo $brand->name;  ?><!--<span> (<?php echo $brand->count; ?>)</span>--></a>
                  </li>
                  <?php
                  if ($i >= 4) break;
                  $i++;
                }
                ?>
              </ul>
          </div>
        </div>

        <div class="col-4 mt-5">
    			<div class="box-product-categories">
              <h6 class="">Top Diabetic Medications</h6>
              <ul class="list-disc mt-5 pl-6">
                <?php
                $args = array(
                       'taxonomy' => 'product_cat',
                       'hide_empty' => true,
                       'parent'   => 23,
                     );
                $i = 1;
                $top_insulin_brands = get_terms($args);
                foreach ($top_insulin_brands as $key => $brand) {
                  ?>
                  <li>
                    <a href="<?php echo get_term_link($brand->term_id); ?>" class=""><?php echo $brand->name;  ?><!--<span> (<?php echo $brand->count; ?>)</span>--></a>
                  </li>
                  <?php
                  if ($i >= 4) break;
                  $i++;
                }

                ?>
              </ul>
    	   </div>
      </div>
      <div class="col-4 mt-5">
  			<div class="box-product-categories">
            <h6 class="">Top Diabetic supplies</h6>
            <ul class="list-disc mt-5 pl-6">
              <?php
              $args = array(
                     'taxonomy' => 'product_cat',
                     'hide_empty' => true,
                     'parent'   => 35,
                   );
              $i = 1;
              $top_insulin_brands = get_terms($args);
              foreach ($top_insulin_brands as $key => $brand) {
                ?>
                <li>
                  <a href="<?php echo get_term_link($brand->term_id); ?>" class=""><?php echo $brand->name;  ?><!--<span> (<?php echo $brand->count; ?>)</span>--></a>
                </li>
                <?php
                if ($i >= 4) break;
                $i++;
              }

              ?>
            </ul>
        </div>
      </div>

    </div>

    <div class="row">
      <?php
        $category_name = ['diabetic-supplies', 'hypoglycemic', 'insulin' ];
        $cats = invwp_get_product_categories ($category_name);
        if (! empty ($cats)) {
          foreach ($cats as $id => $cat) {
            ?>
            <div class="col-4 product-categories">
      				<div class="box-product-categories">
                      <h6 class="mb-5"><?php echo '<a href="'.$cat['link'].'">' . $cat['name'] . '</a>'; ?></h6>
                      <?php
                      $i = 1;
                      if (! empty ($cat['sub_cats'])) {
                        echo '<ul class="list-disc pl-6">';
                        foreach ($cat['sub_cats'] as $sub_cat) {
                          echo '<li>';
                            echo '<a href="'.$sub_cat['link'].'">' . $sub_cat['name'] . '</a>';
                          echo '</li>';
                          if ($i >= 4) break;
                          $i++;
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
