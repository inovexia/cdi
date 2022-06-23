<?php
if (!defined('ABSPATH')) {
    exit;
}

class OmnisendLogger
{
    private static $logDebug = false;

    public static function showLogs()
    {
        global $wpdb;
        return $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "omnisend_logs order by id DESC");
    }

    public static function debug($message)
    {
        if (self::$logDebug) {
            OmnisendLogger::generalLogging('debug', '', '', $message);
        }
    }

    /**
     * This function should be placed in each function that is called by hook
     * Will log info about hook if $logDebug is enabled
     */
    public static function hook()
    {
        if (!self::$logDebug) {
            return;
        }

        $trace = debug_backtrace();
        $action = !empty($trace[1]['function']) ? $trace[1]['function'] : '---';
        if (!empty($trace[1]['class'])) {
            $action .= $trace[1]['class'] . '::';
        }

        $hook = '---';
        foreach ($trace as $item) {
            if ($item['function'] == 'do_action' && empty($item['class'])) {
                $hook = $item['args'][0];
                break;
            }
        }

        $message = "$hook | $action";
        OmnisendLogger::generalLogging('hook', '', '', $message);
    }

    public static function info($message)
    {
        OmnisendLogger::generalLogging('info', '', '', $message);
    }

    public static function warning($message)
    {
        OmnisendLogger::generalLogging('warn', '', '', $message);
    }

    public static function error($message)
    {
        OmnisendLogger::generalLogging('error', '', '', $message);
    }

    public static function cleanLogFile()
    {
        global $wpdb;
        $wpdb->query("TRUNCATE TABLE " . $wpdb->prefix . "omnisend_logs");
    }

    public static function generalLogging($type, $endpoint, $url, $message)
    {
        if (get_option("omnisend_logEnabled") == 1) {
            global $wpdb;
            $table_name = $wpdb->prefix . "omnisend_logs";
            if ($wpdb->get_var("SELECT COUNT(*) FROM $table_name") > 100000) {
                delete_option("omnisend_logEnabled");
            } else {
                $wpdb->insert(
                    $table_name, //table
                    array('type' => $type,
                        'date' => current_time('mysql', 1),
                        'url' => $url,
                        'endpoint' => $endpoint,
                        'message' => $message,
                    )
                );
            }
        }
    }

    public static function countItem($endpoint, $inc = 1)
    {
        $key = "omnisend_" . $endpoint . "_sync_count";
        $count = intval(get_option($key)) + $inc;
        update_option($key, $count);

    }

    public static function getSyncCount()
    {
        $products = intval(get_option("omnisend_products_sync_count"));
        $orders = intval(get_option("omnisend_orders_sync_count"));
        $carts = intval(get_option("omnisend_carts_sync_count"));
        $categories = intval(get_option("omnisend_categories_sync_count"));

        $counts = array(
            "products" => $products,
            "orders" => $orders,
            "carts" => $carts,
            "categories" => $categories,
        );
        return $counts;
    }
}
