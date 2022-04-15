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

    <h2>Browse Medications</h2>
    <div class="row">
      <?php
        $cats = get_product_categories ();
        if (! empty ($cats)) {
          foreach ($cats as $id => $cat) {
            ?>
            <div class="col-4">
                <p><?php echo '<a href="'.$cat['link'].'">' . $cat['name'] . '</a>'; ?></p>
                <?php
                if (! empty ($cat['sub_cats'])) {
                  echo '<ul>';
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
