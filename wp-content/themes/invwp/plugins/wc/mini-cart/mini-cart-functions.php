<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Inovexia_WP_Starter
 */

// Utility function that outputs the mini cart content
function my_wc_mini_cart_content(){
    $cart = WC()->cart->get_cart();

    foreach ( $cart as $cart_item_key => $cart_item  ):
        $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
        $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
            $product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
            $thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
            $product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
            if(isset($cart_item['variation']['attribute_pa_size'])) {
                $variation_val = $cart_item['variation']['attribute_pa_size'];
                $term_obj  = get_term_by('slug', $variation_val, 'pa_size');
                $size_name = $term_obj->name;
            }
            ?>

            <div class="media mini-cart__item woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
               <?php echo $thumbnail; ?>

                <div class="media-body mini-cart__item_body">
                    <div class="mini-cart__item__heading mt-0"><?php echo $product_name; ?></div>
                    <?php
                    echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<div class="cart__item__price">' .
                    sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) .
                    '</div>', $cart_item, $cart_item_key );

                    if( isset($size_name) ) { ?>
                        <div class="mini-cart__item__size"><?php echo $size_name; ?></div>
                    <?php } ?>
                </div>

                <div class="mini-cart__item_remove ">
                    <?php
                    echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                        '<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">&times;</a>',
                        esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                        __( 'Remove this item', 'woocommerce' ),
                        esc_attr( $product_id ),
                        esc_attr( $cart_item_key ),
                        esc_attr( $_product->get_sku() )
                    ), $cart_item_key );
                    ?>
                </div>
            </div>
            <?php
        }
    endforeach; ?>

    <a href="<?php echo get_permalink( wc_get_page_id( 'checkout' ) ); ?>" class="btn btn-dark btn-block"><span class="btn__text"><?php _e('Checkout', 'frosted'); ?></span></a>
    <?php
}

// Hooked: The mini cart count and the cart content
add_action( 'frosted_header_top', 'my_wc_mini_cart' );
function my_wc_mini_cart() {
    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
        $count = WC()->cart->get_cart_contents_count();
        ?>
        <a href="#"><?php _e('Cart', 'frosted'); ?> <span id="cart_count" class="cart__amount"><?php echo esc_html( $count ); ?></span></a>
        <div id="mini-cart-content" class="sub-menu sub-menu--right sub-menu--cart">
        <?php my_wc_mini_cart_content(); ?>
        </div>
        <?php
    }
}

// Ajax refreshing mini cart count and content
add_filter( 'woocommerce_add_to_cart_fragments', 'my_header_add_to_cart_fragment' );
function my_header_add_to_cart_fragment( $fragments ) {
    $count = WC()->cart->get_cart_contents_count();

    $fragments['#cart_count'] = '<span id="cart_count" class="cart__amount">' . esc_attr( $count ) . '</span>';

    ob_start();
    ?>
    <div id="mini-cart-content" class="sub-menu sub-menu--right sub-menu--cart">
    <?php my_wc_mini_cart_content(); ?>
    <div>
    <?php

    $fragments['#mini-cart-content'] = ob_get_clean();

    return $fragments;
}
