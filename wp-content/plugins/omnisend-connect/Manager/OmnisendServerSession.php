<?php
if (!defined('ABSPATH')) {
    exit;
}

class OmnisendServerSession
{
    /**
     * @param string $key
     * @param mixed $data
     *
     * @return bool
     */
    public static function set($key, $data) {
        if (!self::isSessionAvailable()) {
            return false;
        }

        WC()->session->set($key, $data);

        return true;
    }

    /**
     * @param string $key
     *
     * @return mixed (null if not found or session not available)
     */
    public static function get($key) {
        if (!self::isSessionAvailable()) {
            return null;
        }

        return WC()->session->get($key);
    }

    private static function isSessionAvailable() {
        if (!function_exists('WC')) {
            return false;
        }

        if (WC()->session == null) {
            return false;
        }

        return true;
    }
}