<?php if ( ! WC()->cart->is_empty() ) : ?>

<form class="woocommerce-cart-form checkout-mini-cart" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

  <ul class="woocommerce-mini-cart cart_list list-group list-group-flush product_list_widget">
    <?php
  		do_action( 'woocommerce_before_mini_cart_contents' );

  		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
  			$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
  			$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

  			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
  				$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
  				$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
  				$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
  				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
  				?>
    <li class="woocommerce-mini-cart-item list-group-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">

      <div class="row">
        <div class="col-sm-6 col-md-4 mini-cart-img">
          <figure class="figure cart-thumbnail">
            <div class="rectangle-184"></div>
            <?php if ( empty( $product_permalink ) ) : ?>
            <?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
            <?php else : ?>
            <a href="<?php echo esc_url( $product_permalink ); ?>">
              <?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
            </a>
            <?php endif; ?>
          </figure>
        </div>

        <div class="col-sm-6 col-md-8">
          <div class="w-100">
            <?php if ( empty( $product_permalink ) ) : ?>
            <?php echo wp_kses_post( $product_name ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
            <?php else : ?>
            <a href="<?php echo esc_url( $product_permalink ); ?>" class="text-50 montserrat-normal-ebony-clay-18px">
              <?php echo wp_kses_post( $product_name ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
            </a>
            <?php endif; ?>
          </div>

          <div class="w-100">
            <?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
            <?php //echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
          </div>

          <div class="w-100">
            <?php
  								if ( $_product->is_sold_individually() ) {
  									$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
  								} else {
  									$product_quantity = woocommerce_quantity_input(
  										array(
  											'input_name'   => "cart[{$cart_item_key}][qty]",
  											'input_value'  => $cart_item['quantity'],
  											'max_value'    => $_product->get_max_purchase_quantity(),
  											'min_value'    => '0',
  											'product_name' => $_product->get_name(),
  										),
  										$_product,
  										false
  									);
  								}
                  echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
  								//echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
  								?>
          </div>

          <div class="w-100">
            <?php
  								echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
  									'woocommerce_cart_item_remove_link',
  									sprintf(
  										'<a href="%s" class="remove remove_from_cart_button montserrat-normal-ebony-clay-18px" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">Remove</a>',
  										esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
  										esc_attr__( 'Remove this item', 'woocommerce' ),
  										esc_attr( $product_id ),
  										esc_attr( $cart_item_key ),
  										esc_attr( $_product->get_sku() )
  									),
  									$cart_item_key
  								);
  								?>
          </div>

        </div>
      </div>
    </li>
    <?php
  			}
  		}

  		do_action( 'woocommerce_mini_cart_contents' );
  		?>
  </ul>


  <p class="woocommerce-mini-cart__total total">
    <?php
  		/**
  		 * Hook: woocommerce_widget_shopping_cart_total.
  		 *
  		 * @hooked woocommerce_widget_shopping_cart_subtotal - 10
  		 */
  		//do_action( 'woocommerce_widget_shopping_cart_total' );
  		?>
  </p>

  <button type="submit" class="button update_cart d-none" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

</form>

<table class="table ">
  <tbody>
    <?php
   		do_action( 'woocommerce_review_order_before_cart_contents' );

   		do_action( 'woocommerce_review_order_after_cart_contents' );
   		?>
  </tbody>
  <tfoot>

    <tr class="cart-subtotal">
      <th class="subtotal montserrat-normal-ebony-clay-18px"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
      <td class="x-14000 montserrat-normal-ebony-clay-18px"><?php wc_cart_totals_subtotal_html(); ?></td>
    </tr>

    <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
    <tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
      <th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
      <td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
    </tr>
    <?php endforeach; ?>

    <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

    <?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

    <?php wc_cart_totals_shipping_html(); ?>

    <?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

    <?php endif; ?>

    <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
    <tr class="fee">
      <th><?php echo esc_html( $fee->name ); ?></th>
      <td><?php wc_cart_totals_fee_html( $fee ); ?></td>
    </tr>
    <?php endforeach; ?>

    <?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
    <?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
    <?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited ?>
    <tr class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
      <th><?php echo esc_html( $tax->label ); ?></th>
      <td><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
    </tr>
    <?php endforeach; ?>
    <?php else : ?>
    <tr class="tax-total">
      <th><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
      <td><?php wc_cart_totals_taxes_total_html(); ?></td>
    </tr>
    <?php endif; ?>
    <?php endif; ?>

    <?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

    <tr class="order-total">
      <th class="subtotal montserrat-normal-ebony-clay-18px"><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
      <td class="x-14000 montserrat-normal-ebony-clay-18px"><?php wc_cart_totals_order_total_html(); ?></td>
    </tr>

    <?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

  </tfoot>
</table>

<?php else : ?>

<p class="woocommerce-mini-cart__empty-message"><?php esc_html_e( 'No products in the cart.', 'woocommerce' ); ?></p>

<?php endif; ?>