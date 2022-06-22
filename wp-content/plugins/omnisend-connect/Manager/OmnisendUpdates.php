<?php

if (!defined('ABSPATH')) {
    exit;
}

class OmnisendUpdates
{
    public static function update($vFrom, $vTo)
    {
        // Run categories sync
        if (version_compare($vFrom, '1.4.0', '<')) {
            OmnisendInitSyncManager::startCategoriesIfNotFinished();
        }
    }
}
