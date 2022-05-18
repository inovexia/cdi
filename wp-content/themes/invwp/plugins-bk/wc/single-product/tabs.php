<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Inovexia_WP_Starter
 */

/**
  * Remove existing hook for product tabs on single product page
  * @hooked woocommerce_output_product_data_tabs - 10
 **/
//remove_action ('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs' );

add_action ('invwp_woocommerce_show_product_description', 'invwp_woocommerce_show_product_description', 5);
function invwp_woocommerce_show_product_description () {
  woocommerce_get_template( 'single-product/tabs/description.php' );
}

/* Functions to change single product tabs */
add_filter( 'woocommerce_product_tabs', 'woo_custom_product_tabs' );
function woo_custom_product_tabs( $tabs ) {
  // 1) Removing tabs
  unset( $tabs['description'] );              // Remove the description tab
  //unset( $tabs['reviews'] );               // Remove the reviews tab
  unset( $tabs['additional_information'] );   // Remove the additional information tab

  /* 2 Adding new tabs and set the right order
  //Attribute Description tab
  $tabs['attrib_desc_tab'] = array(
      'title'     => __( '', 'woocommerce' ),
      'priority'  => 100,
      'callback'  => 'woo_attrib_desc_tab_content'
  );

   Adds the qty pricing  tab
  $tabs['qty_pricing_tab'] = array(
      'title'     => __( 'Quantity Pricing', 'woocommerce' ),
      'priority'  => 110,
      'callback'  => 'woo_qty_pricing_tab_content'
  );

  // Adds the other products tab
  $tabs['other_products_tab'] = array(
      'title'     => __( 'Other Products', 'woocommerce' ),
      'priority'  => 120,
      'callback'  => 'woo_other_products_tab_content'
  );*/
  return $tabs;
}

// New Tab contents
function woo_attrib_desc_tab_content() {
    // The attribute description tab content
    echo '<h4 class="mb-5">Description</h4>';
	echo '<div class="product-desc mt-5 mb-5">';
	the_content();
	echo '</div>';

}
/*function woo_qty_pricing_tab_content() {
    // The qty pricing tab content
    echo '<h4>Quantity Pricing</h4>';
    echo '<p>Here\'s your quantity pricing tab.</p>';
}
function woo_other_products_tab_content() {
    // The other products tab content
    echo '<h4>Other Products</h4>';
    echo '<p>Here\'s your other products tab.</p>';
}*/

//add_action( 'wp_head', 'invwps_align_tabs' );
function invwps_align_tabs () {
  ?>
  <style media="screen">
    .woocommerce-tabs {
      align-items: center;
      margin: 0 auto;
    }
    .woocommerce-tabs ul {
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .woocommerce-tabs ul.tabs li{
      margin: 0px 5px;
    }
   </style>
   <?php
}
