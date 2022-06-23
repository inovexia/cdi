<?php
if (!defined('ABSPATH')) {
    exit;
}

class OmnisendCart
{

    /*Required*/
    public $cartID;
    public $email;
    public $contactID;
    public $attributionID;
    public $currency;
    public $cartSum;
    public $cartRecoveryUrl;
    public $products = [];

    /**
     * @return OmnisendCart|null
     */
    public static function create()
    {
        try {
            return new OmnisendCart();
        } catch (OmnisendEmptyRequiredFieldsException $exception) {
            return null;
        }
    }

    /**
     * @throws OmnisendEmptyRequiredFieldsException
     */
    private function __construct()
    {
        global $woocommerce;

        $wcCart = $woocommerce->cart->get_cart();

        $this->setCartId();

        $email = wp_get_current_user()->user_email;
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
        }elseif (OmnisendUserStorage::getContactId()) {
            $this->contactID = OmnisendUserStorage::getContactId();
        } else {
            throw new OmnisendEmptyRequiredFieldsException();
        }

        if (OmnisendUserStorage::getAttributionId()) {
            $this->attributionID = OmnisendUserStorage::getAttributionId();
        }

        $this->cartRecoveryUrl = get_site_url() . '/?action=restoreCart&cartID=' . $this->cartID;

        $this->currency = get_woocommerce_currency();
        if ($wcCart) {
            $this->cartSum = OmnisendHelper::priceToCents(WC()->cart->total);
            foreach ($wcCart as $cart_item_key => $wcProduct) {

                $product = [];

                $product['cartProductID'] = $cart_item_key;
                $product['productID'] = "" . $wcProduct['product_id'];
                $product['variantID'] = "" . $wcProduct['variation_id'];
                if (empty($product['variantID'])) {
                    $product['variantID'] = $product['productID'];
                }
                $product['quantity'] = intval($wcProduct['quantity']);
                $product['productUrl'] = get_permalink($wcProduct['product_id']);

                $wcProductDetails = wc_get_product($wcProduct['product_id']);
                if ($wcProductDetails) {
                    $product['sku'] = "" . $wcProductDetails->get_sku();
                    $product['title'] = $wcProductDetails->get_name();
                    $product['description'] = implode(' ', array_slice(explode(' ', preg_replace('#\[[^\]]+\]#', '', $wcProductDetails->get_description())), 0, 30));
                    $product['price'] = OmnisendHelper::priceToCents($wcProductDetails->get_price());
                    if ($wcProductDetails->is_on_sale() && $wcProductDetails->get_regular_price() != $wcProductDetails->get_price() && is_numeric($wcProductDetails->get_regular_price())) {
                        $discount = OmnisendHelper::priceToCents($wcProductDetails->get_regular_price() - $wcProductDetails->get_price());
                        if ($discount > 0) {
                            $product['discount'] = $discount;
                        }
                    }
                    $imageUrl = wp_get_attachment_url($wcProductDetails->get_image_id());
                    if (filter_var($imageUrl, FILTER_VALIDATE_URL)) {
                        $product['imageUrl'] = $imageUrl;
                    }
                }

                if (!empty($product['cartProductID']) && !empty($product['productID']) && isset($product['variantID']) && !empty($product['title'])
                    && !empty($product['quantity']) && isset($product['price'])) {
                    array_push($this->products, $product);
                }
            }
        } else {
            $this->cartSum = 0;
        }
        if (empty($this->cartID) || (empty($this->email) && empty($this->contactID)) || empty($this->currency) || !isset($this->cartSum)) {
            throw new OmnisendEmptyRequiredFieldsException();
        }
    }

    private function setCartId()
    {

        $omnisend_cartID = null === WC()->session ? "" : WC()->session->get('omnisend_cartID');
        if ($omnisend_cartID == "") {
            $user_id = get_current_user_id();
            if ($user_id > 0) {
                $omnisend_cartID = get_user_meta($user_id, "omnisend_cartID", true);
            }
            if ($omnisend_cartID == "") {
                $omnisend_cartID = "wc_cart_" . get_current_user_id() . '_' . time() . '_' . rand(1000, 9999);
                if ($user_id > 0) {
                    update_user_meta($user_id, "omnisend_cartID", $omnisend_cartID);
                }
            }
            if (null !== WC()->session) {
                WC()->session->set('omnisend_cartID', $omnisend_cartID);
            }

        }
        $this->cartID = $omnisend_cartID;

    }

}
