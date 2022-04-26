<section class="full-width top-header-section">
  <div class="container">
    <div class="top-header">
      <div class="row">
        <div class="col-2">
          <div class="top-header-style-2">
            <?php dynamic_sidebar('top-header-menu'); ?>
          </div>
        </div>
        <div class="col-3">
          <div class="top-header-style-2">
            <?php dynamic_sidebar('top-header-menu1'); ?>
          </div>
        </div>
        <div class="col-7 top-header-search text-right">
          <?php //dynamic_sidebar('top-header-menu2'); ?>
			<?php
			//if (isset ($_GET['product_name'])
			?>
			<form role="search" method="get" id="searchform" action="">
			<div>
				<input type="text" value="" name="s" id="s" />
				<select name="product_cat">
					<option value="0" class="product-cat">All Categories</option>
					<?php
			        $cats = get_product_categories ($category_name);
					if (! empty ($cats)) {
					  foreach ($cats as $id => $cat) {
						?>
						<option value="<?php echo $id; ?>" class="product-cat"><?php echo $cat['name']; ?></option>
						<?php
						if (! empty ($cat['sub_cats'])) {
						  foreach ($cat['sub_cats'] as $sub_cat_id=>$sub_cat) {
							?>
							<option value="<?php echo $sub_cat_id; ?>" class="product-sub-cat">--<?php echo $sub_cat['name']; ?></option>
							<?php
						  }
						}
						?>
						<?php						
					  }
					}

					?>
				</select>
				<input type="hidden" value="1" name="sentence" />
				<input type="hidden" value="product" name="post_type" />
				<input type="submit" id="searchsubmit" value="Search" />
			</div>
			</form>
        </div>
      </div>
    </div>
  </div>
</section>
