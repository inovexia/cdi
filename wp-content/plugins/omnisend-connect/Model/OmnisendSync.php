<?php

class OmnisendSync
{
    const FIELD_NAME = 'omnisend_last_sync';
    const STATUS_ERROR = 'error';
    const STATUS_SKIPPED = 'skipped';

    public static function wasOrderSyncedBefore($orderId) {
        $lastSync = self::getOrderSyncStatus($orderId);
        return !empty($lastSync) && !in_array($lastSync, [self::STATUS_ERROR, self::STATUS_SKIPPED]);
    }

    public static function getOrderSyncStatus($orderId) {
        return get_post_meta($orderId, self::FIELD_NAME, true);
    }

    public static function markOrderSyncAsError($orderId) {
        update_post_meta($orderId, self::FIELD_NAME, self::STATUS_ERROR);
    }

    public static function markOrderSyncAsSkipped($orderId) {
        update_post_meta($orderId, self::FIELD_NAME, self::STATUS_SKIPPED);
    }

    public static function markOrderSyncAsSynced($orderId) {
        update_post_meta($orderId, self::FIELD_NAME, date(DATE_ATOM));
    }

    public static function markContactAsSynced($userId) {
        update_user_meta($userId, self::FIELD_NAME, date(DATE_ATOM, time()));
    }

    public static function markContactAsError($userId) {
        update_user_meta($userId, self::FIELD_NAME, self::STATUS_ERROR);
    }

    public static function wasCategorySyncedBefore($categoryId) {
        $lastSync = self::getCategorySyncStatus($categoryId);
        return !empty($lastSync) && $lastSync != OmnisendSync::STATUS_ERROR;
    }

    public static function getCategorySyncStatus($categoryId) {
        return get_term_meta($categoryId, self::FIELD_NAME, true);
    }

    public static function markCategorySyncAsSynced($categoryId) {
        update_term_meta($categoryId, self::FIELD_NAME, date(DATE_ATOM));
    }
}