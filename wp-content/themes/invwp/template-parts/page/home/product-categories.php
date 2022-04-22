<section class="home-product-categories pb-5">
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

    <div class="row">
      <?php
        $category_name = ['insulin', 'hypoglycemic', 'diabetic-supplies'];
        $cats = get_product_categories ($category_name);
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
