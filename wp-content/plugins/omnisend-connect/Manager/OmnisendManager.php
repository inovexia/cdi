<?php
if (!defined('ABSPATH')) {
    exit;
}

$omnisend_product = "";

class OmnisendEmptyRequiredFieldsException extends Exception
{}

class OmnisendManager
{
    const HTTP_STATUS_CODES_TO_RETRY_POST_IN_PUT = [400, 404, 422];
    const VERB_POST = 'POST';
    const VERB_PUT = 'PUT';

    /**
     * @return bool
     */
    public static function isSetup() {
        if (empty(get_option('omnisend_api_key', null))) {
            return false;
        }

        if (!OmnisendHelper::isWooCommercePluginActivated()) {
            return false;
        }

        return true;
    }

    public static function pushCartToOmnisend()
    {
        OmnisendLogger::debug("pushCartToOmnisend: start");
        if (!self::isSetup()) {
            return;
        }

        $cartObject = OmnisendCart::create();
        if (!$cartObject) {
            OmnisendLogger::debug("pushCartToOmnisend: cart was not created");
            return;
        }

        $cartArray = OmnisendHelper::cleanModelFromEmptyFields($cartObject);
        if (OmnisendServerSession::get("omnisend_cart") == $cartArray) {
            OmnisendLogger::debug("pushCartToOmnisend cart did not change");
            return; // nothing changed, no need update
        }

        $cartWasSyncedBefore = OmnisendServerSession::get('omnisend_cart_synced');
        $verbsToTry = $cartWasSyncedBefore ? [self::VERB_PUT] : [self::VERB_POST, self::VERB_PUT];

        foreach ($verbsToTry as $verb) {
            $apiUrl = $verb == self::VERB_POST ? OMNISEND_URL . 'carts' : OMNISEND_URL . 'carts/' . $cartObject->cartID;
            $curlResult = OmnisendHelper::omnisendApi($apiUrl, $verb, $cartArray);

            if ($curlResult['code'] >= 200 && $curlResult['code'] < 300) {
                OmnisendLogger::generalLogging("info", "carts", $apiUrl, 'Cart #' . $cartObject->cartID . ' was successfully pushed to Omnisend.');
                OmnisendServerSession::set('omnisend_cart_synced', 1);
                OmnisendServerSession::set("omnisend_cart", $cartArray);
                OmnisendLogger::countItem("carts");
                return;
            }

            if (in_array($curlResult['code'], self::HTTP_STATUS_CODES_TO_RETRY_POST_IN_PUT)) {
                OmnisendLogger::generalLogging("warn", "carts", $apiUrl, 'Unable to push cart #' . $cartObject->cartID . ' to Omnisend.' . $curlResult['response']);
                continue;
            }

            if ($curlResult['code'] == 403) {
                OmnisendLogger::generalLogging("warn", "carts", $apiUrl, 'Unable to push cart #' . $cartObject->cartID . ' to Omnisend. You do not have rights to push carts.');
                break;
            }

            OmnisendLogger::generalLogging("warn", "carts", $apiUrl, 'Unable to push cart #' . $cartObject->cartID . ' to Omnisend. May be server error. ' . $curlResult['response']);
            break;
        }
        OmnisendServerSession::set('omnisend_cart_synced', null);
    }

    public static function pushContactToOmnisend($userId)
    {
        if (is_admin() || !self::isSetup()) {
            return;
        }

        $user = get_userdata($userId);
        if (empty($user)) {
            OmnisendLogger::generalLogging("warn", "contacts", '', 'User not found');
            return;
        }

        $contactObject = OmnisendContact::create($user);
        if (!$contactObject) {
            OmnisendLogger::generalLogging("warn", "contacts", '', 'Contact was not created (missing required fields');
            return;
        }

        $contactArray = OmnisendHelper::cleanModelFromEmptyFields($contactObject);
        if (OmnisendServerSession::get('omnisend_contact') == $contactArray) {
            return;
        }

        $apiUrl = OMNISEND_URL . "contacts";
        $curlResult = OmnisendHelper::omnisendApi($apiUrl, self::VERB_POST, $contactArray);
        if ($curlResult['code'] >= 200 && $curlResult['code'] < 300) {
            $response = json_decode($curlResult['response'], true);
            if (!empty($response["contactID"])) {
                OmnisendContactResolver::updateByEmailAndContactId($contactObject->email, $response["contactID"]);
            }
            OmnisendLogger::generalLogging("info", "contacts", $apiUrl, 'Contact ' . $contactObject->email . ' was successfully pushed to Omnisend.');
            OmnisendSync::markContactAsSynced($user->ID);
            OmnisendServerSession::set('omnisend_contact', $contactArray);
            return;
        }

        if ($curlResult['code'] == 403) {
            OmnisendLogger::generalLogging("warn", "contacts", $apiUrl, 'Unable to push contact ' . $contactObject->email . " to Omnisend. You don't have rights to push contacts.");
            OmnisendSync::markContactAsError($user->ID);
            return;
        }

        if ($curlResult['code'] == 400 || $curlResult['code'] == 422) {
            OmnisendLogger::generalLogging("warn", "contacts", $apiUrl, 'Unable to push contact ' . $contactObject->email . ' to Omnisend.' . $curlResult['response']);
            OmnisendSync::markContactAsError($user->ID);
            return;
        }

        OmnisendLogger::generalLogging("warn", "contacts", $apiUrl, 'Unable to push contact ' . $contactObject->email . ' to Omnisend. May be server error. ' . $curlResult['response']);
        OmnisendSync::markContactAsError($user->ID);
    }

    public static function pushCategoryToOmnisend($termId)
    {
        if (!self::isSetup()) {
            return;
        }

        $category = OmnisendCategory::createFromId($termId);
        if (!$category) {
            OmnisendLogger::generalLogging("warn", "categories", '', "Unable to push category #$termId to Omnisend. One or more required fields are empty or invalid");
            return;
        }

        $verbsToTry = OmnisendSync::wasCategorySyncedBefore($category->id) ? [self::VERB_PUT] : [self::VERB_POST, self::VERB_PUT];
        foreach ($verbsToTry as $verb) {
            $apiUrl = $verb == self::VERB_POST ? OMNISEND_URL . 'categories' : OMNISEND_URL . 'categories/' . $category->id;
            $curlResult = OmnisendHelper::omnisendApi($apiUrl, $verb, $category->toArray());

            if ($curlResult['code'] >= 200 && $curlResult['code'] < 300) {
                OmnisendLogger::generalLogging("info", "categories", $apiUrl, "Category #$category->id was successfully pushed to Omnisend.");
                OmnisendLogger::countItem("categories");
                OmnisendSync::markCategorySyncAsSynced($category->id);
                return;
            }

            if (in_array($curlResult['code'], self::HTTP_STATUS_CODES_TO_RETRY_POST_IN_PUT)) {
                OmnisendLogger::generalLogging("warn", "categories", $apiUrl, "Unable to push category #$category->id to Omnisend. {$curlResult['response']}");
                continue;
            }

            if ($curlResult['code'] == 403) {
                OmnisendLogger::generalLogging("warn", "categories", $apiUrl, "Unable to push category #$category->id to Omnisend. You don't have rights to push categories.");
                break;
            }

            OmnisendLogger::generalLogging("warn", "categories", $apiUrl, "Unable to push category #$category->id to Omnisend. May be server error. {$curlResult['response']}");
            break;
        }

        OmnisendSync::markCategorySyncAsSynced($category->id);
    }

    public static function deleteCategoryFromOmnisend($id)
    {
        if (!empty(get_option('omnisend_api_key', null))) {
            $link = OMNISEND_URL . "categories/" . $id;
            $curlResult = OmnisendHelper::omnisendApi($link, "DELETE", []);
            return $curlResult['response'];
        }

    }

    public static function pushProductToOmnisend($productId = '', $put = 0, $iter = 0)
    {
        global $omnisend_product;
        if (!empty(get_option('omnisend_api_key', null))) {
            $preparedProduct = OmnisendProduct::create($productId);
            $returnResult = array();
            /*If all required fields are set, push product to Omnisend*/
            if ($preparedProduct) {
                if (!$preparedProduct->published) {
                    OmnisendLogger::info("Skip product #{$preparedProduct->productID} sync, because it is not 'published'");
                    return;
                }

                $preparedProduct = OmnisendHelper::cleanModelFromEmptyFields($preparedProduct);
                $lastSync = get_post_meta($productId, 'omnisend_last_sync', true);
                if ($omnisend_product != $preparedProduct) {
                    if ($put == 1 || (!empty($lastSync) && $lastSync != OmnisendSync::STATUS_ERROR && $put == 0)) {
                        $put = 1;
                        /*If product already exists - try to update*/
                        $link = OMNISEND_URL . "products/" . $productId;
                        $curlResult = OmnisendHelper::omnisendApi($link, "PUT", $preparedProduct);
                    } else {
                        $put = 0;
                        $link = OMNISEND_URL . "products";
                        $curlResult = OmnisendHelper::omnisendApi($link, "POST", $preparedProduct);
                    }

                    if ($curlResult['code'] >= 200 && $curlResult['code'] < 300) {
                        OmnisendLogger::generalLogging("info", "products", $link, 'Product #' . $productId . ' was succesfully pushed to Omnisend.');
                        update_post_meta($productId, 'omnisend_last_sync', date(DATE_ATOM, time()));
                        OmnisendLogger::countItem("products");
                        $omnisend_product = $preparedProduct;
                    } elseif ($curlResult['code'] == 403) {
                        OmnisendLogger::generalLogging("warn", "products", $link, 'Unable to push procduct #' . $productId . " to Omnisend. You don't have rights to push products.");
                    } elseif ($curlResult['code'] == 400 || $curlResult['code'] == 404 || $curlResult['code'] == 422) {
                        if ($iter == 0) {
                            //try other method
                            OmnisendManager::pushProductToOmnisend($productId, $put + 1, $iter + 1);
                        } else {
                            OmnisendLogger::generalLogging("warn", "products", $link, 'Unable to push procduct #' . $productId . " to Omnisend." . $curlResult['response']);
                            if (empty($lastSync)) {
                                update_post_meta($productId, 'omnisend_last_sync', OmnisendSync::STATUS_ERROR);
                            }
                        }
                    } else {
                        OmnisendLogger::generalLogging("warn", "products", $link, 'Unable to push procduct #' . $productId . " to Omnisend. May be server error. " . $curlResult['response']);
                    }
                }

            } else {
                $message = 'Unable to push product #' . $productId . ' to Omnisend. One or more required fields are empty or invalid';
                OmnisendLogger::generalLogging("warn", "products", '', $message);
            }
        }
    }

    public static function pushOrderToOmnisend($orderId)
    {
        if (!self::isSetup()) {
            return;
        }

        $orderObject = OmnisendOrder::create($orderId);
        if (!$orderObject) {
            $message = 'Unable to push Order #' . $orderId . ' to Omnisend. One or more required fields are empty or invalid';
            OmnisendLogger::generalLogging("warn", "orders", '', $message);
            OmnisendSync::markOrderSyncAsSkipped($orderId);
            return;
        }

        $orderArray = OmnisendHelper::cleanModelFromEmptyFields($orderObject);
        $verbsToTry = OmnisendSync::wasOrderSyncedBefore($orderId) ? [self::VERB_PUT] : [self::VERB_POST, self::VERB_PUT];

        foreach ($verbsToTry as $verb) {
            $apiUrl = $verb == self::VERB_POST ? OMNISEND_URL . 'orders' : OMNISEND_URL . 'orders/' . $orderId;
            $curlResult = OmnisendHelper::omnisendApi($apiUrl, $verb, $orderArray);

            if ($curlResult['code'] >= 200 && $curlResult['code'] < 300) {
                OmnisendLogger::generalLogging("info", "orders", $apiUrl, "Order #$orderId was successfully pushed to Omnisend.");
                OmnisendLogger::countItem("orders");
                OmnisendSync::markOrderSyncAsSynced($orderId);
                OmnisendContactResolver::updateByEmail($orderObject->email);
                return;
            }

            if (in_array($curlResult['code'], self::HTTP_STATUS_CODES_TO_RETRY_POST_IN_PUT)) {
                OmnisendLogger::generalLogging("warn", "orders", $apiUrl, 'Unable to push order #' . $orderId . ' to Omnisend.' . $curlResult['response']);
                continue;
            }

            if ($curlResult['code'] == 403) {
                OmnisendLogger::generalLogging("warn", "orders", $apiUrl, "Unable to push order #$orderId to Omnisend. You don't have rights to push orders.");
                break;
            }

            OmnisendLogger::generalLogging("warn", "orders", $apiUrl, "Unable to push order #$orderId to Omnisend. May be server error. " . $curlResult['response']);
            break;
        }

        OmnisendSync::markOrderSyncAsError($orderId);
    }

    public static function updateOrderStatus($orderId, $statusType, $orderStatus)
    {
        if (!self::isSetup()) {
            return;
        }

        /* Order is not synced - try to push */
        if (!OmnisendSync::wasOrderSyncedBefore($orderId)) {
            OmnisendManager::pushOrderToOmnisend($orderId);
            return;
        }

        /* Order already synced - try to update */
        $postData = [];

        if ($statusType == "fulfillment") {
            $postData["fulfillmentStatus"] = $orderStatus;
        } else {
            $postData["paymentStatus"] = $orderStatus;
        }

        if ($orderStatus == "voided") {
            $postData["canceledDate"] = date(DATE_ATOM, time());
        }
        
        $link = OMNISEND_URL . "orders/" . $orderId;
        $curlResult = OmnisendHelper::omnisendApi($link, "PATCH", $postData);

        if ($curlResult['code'] >= 200 && $curlResult['code'] < 300) {
            OmnisendLogger::generalLogging("info", "orders", $link, "Order #$orderId status change ($orderStatus) was succesfully pushed to Omnisend");
            OmnisendLogger::countItem("orders");
            OmnisendSync::markOrderSyncAsSynced($orderId);
        } elseif ($curlResult['code'] == 403) {
            OmnisendLogger::generalLogging("warn", "orders", $link, 'Unable to push order #' . $orderId . " status change ($orderStatus) to Omnisend. You don't have rights to push orders.");
        } elseif ($curlResult['code'] == 400 || $curlResult['code'] == 404 || $curlResult['code'] == 422) {
            OmnisendLogger::generalLogging("warn", "orders", $link, 'Unable to push order #' . $orderId . " status change ($orderStatus) to Omnisend. " . $curlResult['response']);
            OmnisendSync::markOrderSyncAsError($orderId);
        } else {
            OmnisendLogger::generalLogging("warn", "orders", $link, 'Unable to push order #' . $orderId . " status change ($orderStatus) to Omnisend. May be server error. " . $curlResult['response']);
        }
    }

    public static function deleteProductFromOmnisend($id)
    {
        if (!empty(get_option('omnisend_api_key', null))) {
            $link = OMNISEND_URL . "products/" . $id;
            $curlResult = OmnisendHelper::omnisendApi($link, "DELETE", []);

            return $curlResult['response'];
        }

    }

    public static function updateAccountInfo($data = "")
    {
        if (!empty(get_option('omnisend_api_key', null))) {
            if ($data == "") {
                $data = OmnisendHelper::getAccountInfo();
            }
            $link = OMNISEND_URL . "accounts/" . get_option('omnisend_account_id', null);
            $curlResult = OmnisendHelper::omnisendApi($link, "POST", $data);
            if ($curlResult['code'] >= 200 && $curlResult['code'] < 300) {
                update_option('omnisend_wp_version', get_bloginfo('version'));
                OmnisendLogger::generalLogging("info", "account", $link, 'Account information has been updated.');
            } elseif ($curlResult['code'] == 403) {
                OmnisendLogger::generalLogging("warn", "account", $link, 'Unable to update account information');
            } elseif ($curlResult['code'] == 400 || $curlResult['code'] == 404 || $curlResult['code'] == 422) {
                OmnisendLogger::generalLogging("warn", "account", $link, 'Unable to update account information. ' . $curlResult['response']);
            } else {
                OmnisendLogger::generalLogging("warn", "account", $link, 'Unable to update account information. May be server error. ' . $curlResult['response']);
            }
        }
    }
}
