<div class="mega-menu-wrapper">
    <div class="container">
        <h3>OUR PRODUCTS</h3>
        <div class="row">
            <div class="col-6">
                <h4>All Products </h4>
                <ul class="cat-menu">
                    <?php
                            $terms =  array(
                              'taxonomy' => 'product_cat', 
                              'hide_empty' => false,
                            );
                            $product_brand = get_terms($terms);
                            foreach ($product_brand as $key => $brand) { ?>
                    <li>
                        <a
                            href="<?php echo get_term_link($brand); ?>"><?php echo $brand->name;  ?><span>(<?php echo $brand->count; ?>)</span></a>
                    </li>
                    <?php }  ?>
                </ul>
            </div>
            <div class="col-6">
                <h4>Accessories </h4>
                <ul class="cat-menu">
                    <?php
                            $terms =  array(
                              'taxonomy' => 'product_cat', 
                              'hide_empty' => false,
                            );
                            $product_brand = get_terms($terms);
                            foreach ($product_brand as $key => $brand) { ?>
                    <li>
                        <a
                            href="<?php echo get_term_link($brand); ?>"><?php echo $brand->name;  ?><span>(<?php echo $brand->count; ?>)</span></a>
                    </li>
                    <?php }  ?>
                </ul>
            </div>
            <!-- <div class="col-3">
                <h4>Nullam </h4>
                <ul class="cat-menu">
                    <?php
                            $terms =  array(
                              'taxonomy' => 'product_cat', 
                              'hide_empty' => false,
                            );
                            $product_brand = get_terms($terms);
                            foreach ($product_brand as $key => $brand) { ?>
                    <li>
                        <a
                            href="<?php echo get_term_link($brand); ?>"><?php echo $brand->name;  ?><span>(<?php echo $brand->count; ?>)</span></a>
                    </li>
                    <?php }  ?>
                </ul>
            </div>
            <div class="col-3">
                <h4>Etiam</h4>
                <ul class="cat-menu">
                    <?php
                            $terms =  array(
                              'taxonomy' => 'product_cat', 
                              'hide_empty' => false,
                            );
                            $product_brand = get_terms($terms);
                            foreach ($product_brand as $key => $brand) { ?>
                    <li>
                        <a
                            href="<?php echo get_term_link($brand); ?>"><?php echo $brand->name;  ?><span>(<?php echo $brand->count; ?>)</span></a>
                    </li>
                    <?php }  ?>
                </ul>
            </div> -->
        </div>
    </div>
</div>