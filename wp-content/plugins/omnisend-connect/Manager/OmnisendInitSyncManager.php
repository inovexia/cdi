<?php

if (!defined('ABSPATH')) {
    exit;
}

class OmnisendInitSyncManager 
{
    public static function startContacts() {
        delete_option('omnisend_sync_contacts_finished');
        self::startContactsIfNotFinished();
    }

    public static function startContactsIfNotFinished() {
        $isFinished = get_option('omnisend_sync_contacts_finished', 0) == 1;

        if ($isFinished) {
            OmnisendLogger::info('Contact sync is already finished');
            return;
        }

        if (wp_next_scheduled('omnisend_init_contacts_sync'))  {
            OmnisendLogger::info('Contact sync is already started');
            return;
        }

        OmnisendLogger::info('Contact sync started');
        wp_schedule_event(time(), 'two_minutes', 'omnisend_init_contacts_sync');
        
        self::startCheckBatchesIfNotStarted();
    }

    public static function finishContacts() {
        OmnisendLogger::info('Contact sync finished');
        update_option('omnisend_sync_contacts_finished', 1);

        if (wp_next_scheduled('omnisend_init_contacts_sync')) {
            wp_clear_scheduled_hook('omnisend_init_contacts_sync');
        }
    }

    public static function stopContacts($reason) {
        OmnisendLogger::warning('Contact sync stopped: ' . $reason);

        if (wp_next_scheduled('omnisend_init_contacts_sync')) {
            wp_clear_scheduled_hook('omnisend_init_contacts_sync');
        }
    }

    public static function areContactsSyncing() {
        if (wp_next_scheduled('omnisend_init_contacts_sync')) {
            return true;
        }
        
        return false;
    }

    public static function isContactsFinished() {
        if (get_option("omnisend_sync_contacts_finished") == 1) {
            return true;
        }
        
        return false;
    }

    public static function startResyncContacts() {
        delete_metadata("user", "0", "omnisend_last_sync", '', true);
        self::startContacts();
    }

    public static function startOrders() {
        delete_option('omnisend_sync_orders_finished');
        self::startOrdersIfNotFinished();
    }

    public static function startOrdersIfNotFinished() {
        $isFinished = get_option('omnisend_sync_orders_finished', 0) == 1;

        if ($isFinished) {
            OmnisendLogger::info('Order sync is already finished');
            return;
        }

        if (wp_next_scheduled('omnisend_init_orders_sync'))  {
            OmnisendLogger::info('Order sync is already started');
            return;
        }

        OmnisendLogger::info('Order sync started');
        wp_schedule_event(time(), 'two_minutes', 'omnisend_init_orders_sync');
        
        self::startCheckBatchesIfNotStarted();
    }

    public static function finishOrders() {
        OmnisendLogger::info('Order sync finished');
        update_option('omnisend_sync_orders_finished', 1);

        if (wp_next_scheduled('omnisend_init_orders_sync')) {
            wp_clear_scheduled_hook('omnisend_init_orders_sync');
        }
    }

    public static function stopOrders($reason) {
        OmnisendLogger::warning('Order sync stopped: ' . $reason);

        if (wp_next_scheduled('omnisend_init_orders_sync')) {
            wp_clear_scheduled_hook('omnisend_init_orders_sync');
        }
    }

    public static function areOrdersSyncing() {
        if (wp_next_scheduled('omnisend_init_orders_sync')) {
            return true;
        }
        
        return false;
    }

    public static function isOrdersFinished() {
        if (get_option("omnisend_sync_orders_finished") == 1) {
            return true;
        }
        
        return false;
    }

    public static function startProducts() {
        delete_option('omnisend_sync_products_finished');
        self::startProductsIfNotFinished();
    }

    public static function startProductsIfNotFinished() {
        $isFinished = get_option('omnisend_sync_products_finished', 0) == 1;

        if ($isFinished) {
            OmnisendLogger::info('Product sync is already finished');
            return;
        }

        if (wp_next_scheduled('omnisend_init_products_sync'))  {
            OmnisendLogger::info('Product sync is already started');
            return;
        }

        OmnisendLogger::info('Product sync started');
        wp_schedule_event(time(), 'two_minutes', 'omnisend_init_products_sync');

        self::startCheckBatchesIfNotStarted();
    }

    public static function finishProducts() {
        OmnisendLogger::info('Product sync finished');
        update_option('omnisend_sync_products_finished', 1);

        if (wp_next_scheduled('omnisend_init_products_sync')) {
            wp_clear_scheduled_hook('omnisend_init_products_sync');
        }
    }

    public static function stopProducts($reason) {
        OmnisendLogger::warning('Product sync stopped: ' . $reason);

        if (wp_next_scheduled('omnisend_init_products_sync')) {
            wp_clear_scheduled_hook('omnisend_init_products_sync');
        }
    }

    public static function areProductsSyncing() {
        if (wp_next_scheduled('omnisend_init_products_sync')) {
            return true;
        }
        
        return false;
    }

    public static function isProductsFinished() {
        if (get_option("omnisend_sync_products_finished") == 1) {
            return true;
        }
        
        return false;
    }

    public static function startCategories() {
        delete_option('omnisend_sync_categories_finished');
        self::startCategoriesIfNotFinished();
    }

    public static function startCategoriesIfNotFinished() {
        $isFinished = get_option('omnisend_sync_categories_finished', 0) == 1;

        if ($isFinished) {
            OmnisendLogger::info('Category sync is already finished');
            return;
        }

        if (wp_next_scheduled('omnisend_init_categories_sync'))  {
            OmnisendLogger::info('Category sync is already started');
            return;
        }

        OmnisendLogger::info('Category sync started');
        wp_schedule_event(time(), 'two_minutes', 'omnisend_init_categories_sync');
    }

    public static function finishCategories() {
        OmnisendLogger::info('Category sync finished');
        update_option('omnisend_sync_categories_finished', 1);

        if (wp_next_scheduled('omnisend_init_categories_sync')) {
            wp_clear_scheduled_hook('omnisend_init_categories_sync');
        }
    }

    public static function stopCategories($reason) {
        OmnisendLogger::warning('Category sync stopped: ' . $reason);

        if (wp_next_scheduled('omnisend_init_categories_sync')) {
            wp_clear_scheduled_hook('omnisend_init_categories_sync');
        }
    }

    public static function areCategoriesSyncing() {
        if (wp_next_scheduled('omnisend_init_categories_sync')) {
            return true;
        }
        
        return false;
    }

    public static function isCategoriesFinished() {
        if (get_option("omnisend_sync_categories_finished") == 1) {
            return true;
        }
        
        return false;
    }

    public static function startCheckBatchesIfNotStarted() {
        // Batch checker is already started
        if (wp_next_scheduled('omnisend_batch_check')) {
            return;
        }

        OmnisendLogger::info('Check batches started');
        wp_schedule_event(time(), 'two_minutes', 'omnisend_batch_check');
    }

    public static function finishCheckBatches() {
        if (self::isAllBatchesSyncFinished() && wp_next_scheduled('omnisend_batch_check')) {
            OmnisendLogger::info('Check batches finished');
            wp_clear_scheduled_hook('omnisend_batch_check');
        }
    }

    public static function startResyncAllWithErrorOrSkipped() {
        delete_metadata("user", "0", "omnisend_last_sync", OmnisendSync::STATUS_ERROR, true);
        delete_metadata("post", "0", "omnisend_last_sync", OmnisendSync::STATUS_ERROR, true);
        delete_metadata("term", "0", "omnisend_last_sync", OmnisendSync::STATUS_ERROR, true);
        delete_metadata("user", "0", "omnisend_last_sync", OmnisendSync::STATUS_SKIPPED, true);
        delete_metadata("post", "0", "omnisend_last_sync", OmnisendSync::STATUS_SKIPPED, true);
        
        self::startContacts();
        self::startOrders();
        self::startProducts();
        self::startCategories();
    }

    public static function areDataSyncing() {
        if (self::areContactsSyncing()) {
            return true;
        }

        if (self::areOrdersSyncing()) {
            return true;
        }

        if (self::areProductsSyncing()) {
            return true;
        }

        if (self::areCategoriesSyncing()) {
            return true;
        }

        return false;
    }

    private static function isAllBatchesSyncFinished() {
        if (self::areContactsSyncing()) {
            return false;
        }

        if (self::areOrdersSyncing()) {
            return false;
        }

        if (self::areProductsSyncing()) {
            return false;
        }

        return true;
    }
}