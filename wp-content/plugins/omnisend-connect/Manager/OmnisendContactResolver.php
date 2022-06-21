<?php

class OmnisendContactResolver
{
    public static function updateByUserId($userId)
    {
        if (is_admin()) {
            return;
        }

        $user = get_userdata($userId);
        if (!$user || !is_object($user) || empty($user->user_email)) {
            OmnisendLogger::info("Unable to get user email by ID: " . $userId);
            return;
        }

        $contactId = self::resolveEmailToContactId($user->user_email);
        if (!$contactId) {
            OmnisendLogger::debug("Unable to resolve email $user->user_email to contactId");
            return;
        }

        OmnisendUserStorage::setContactId($contactId);
        OmnisendLogger::debug("ContactID $contactId for email $user->user_email stored in user cookie for cart recovery");
    }

    public static function updateByEmailAndContactId($email, $contactId)
    {
        update_option(self::getStorageKey($email), $contactId, false);
        if (OmnisendUserStorage::getContactId() != $contactId) {
            OmnisendUserStorage::setContactId($contactId);
            OmnisendLogger::debug("ContactID $contactId for email $email stored in user cookie for cart recovery");
        }
    }

    /**
     * @param $email
     *
     * @return bool
     */
    public static function updateByEmail($email) {
        $contactId = self::resolveEmailToContactId($email);
        if (!$contactId) {
            return false;
        }

        if ($contactId == OmnisendUserStorage::getContactId()) {
            return true;
        }

        OmnisendUserStorage::setContactId($contactId);
        OmnisendLogger::debug("ContactID $contactId for email $email stored in user cookie for cart recovery");

        return true;
    }

    /**
     * @param $email
     *
     * @return mixed|null
     */
    private static function resolveEmailToContactId($email)
    {
        $contactId = get_option(self::getStorageKey($email), null);
        if ($contactId) {
            OmnisendLogger::debug("Email $email resolved to contactID $contactId (using WP options table)");
            return $contactId;
        }

        $contactId = self::getContactIdFromOmnisend($email);
        if (!$contactId) {
            return null;
        }

        OmnisendLogger::debug("Email $email resolved to contactID $contactId (using Omnisend API)");
        update_option(self::getStorageKey($email), $contactId, false);

        return $contactId;
    }

    /**
     * @param string $email
     *
     * @return string
     */
    private static function getStorageKey($email)
    {
        return 'omnisend_email_contact_ID_' . $email;
    }

    /**
     * @param $email
     *
     * @return mixed|null
     */
    private static function getContactIdFromOmnisend($email)
    {
        $apiUrl = OMNISEND_URL . "contacts?email=" . urlencode($email);
        $curlResult = OmnisendHelper::omnisendApi($apiUrl, "GET");
        if ($curlResult['code'] < 200 || $curlResult['code'] >= 300) {
            OmnisendLogger::generalLogging('WARN', 'contacts', $apiUrl, 'Unable to resolve contactId from email, code: ' . $curlResult['code']);
            return null;
        }

        $response = json_decode($curlResult['response'], true);
        return $response["contacts"][0]["contactID"];
    }
}