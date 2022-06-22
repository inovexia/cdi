<?php
if (!defined('ABSPATH')) {
    exit;
}

class OmnisendUserStorage
{
    /**
     * @var array values set in running PHP process. When it is needed to set and get value in same process
     */
    private static $paramsSetInProcess = [];

    public static function getAttributionId() {
        return self::get('omnisendAttributionID');
    }

    public static function getContactId() {
        return self::get('omnisendContactID');
    }

    public static function setContactId($contactId) {
        self::set('omnisendContactID', $contactId);
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    private static function get($key) {
        if (array_key_exists($key, self::$paramsSetInProcess)) {
            OmnisendLogger::debug("Get cookie. Key $key. Value: " . self::$paramsSetInProcess[$key]);
            return self::$paramsSetInProcess[$key];
        }

        $value = !empty($_COOKIE[$key]) ? $_COOKIE[$key] : null;
        OmnisendLogger::debug("Get cookie. Key $key. Value: " . $value);

        return $value;
    }

    /**
     * @param string $key
     * @param mixed $data
     */
    private static function set($key, $data) {
        OmnisendLogger::debug("Saving to cookie '$key', value: " . json_encode($data));
        $host = parse_url(get_option('siteurl'), PHP_URL_HOST);
        $expiry = strtotime('+1 year');
        setcookie($key, $data, $expiry, "/", $host);
        self::$paramsSetInProcess[$key] = $data;
    }
}