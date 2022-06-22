<?php
if (!defined('ABSPATH')) {
    exit;
}

const POST_STATUS_PUBLISH = 'publish';

const POST_TYPE_SHOP_ORDER = 'shop_order';
const POST_TYPE_PRODUCT = 'product';

class SyncStats {
    public $total;
    public $unique;
    public $synced;
    public $notSynced;
    public $skipped;
    public $error;

    function __construct($total, $unique, $synced, $notSynced, $skipped, $error) {
        $this->total = $total;
        $this->unique = $unique;
        $this->synced = $synced;
        $this->notSynced = $notSynced;
        $this->skipped = $skipped;
        $this->error = $error;
    }
}

class AllSyncStats {
    /**
     * @var SyncStats
     */
    public $contacts;
    /**
     * @var SyncStats
     */
    public $orders;
    /**
     * @var SyncStats
     */
    public $products;
    /**
     * @var SyncStats
     */
    public $categories;
    /**
     * @var int
     */
    public $carts;

    function __construct(SyncStats $contacts, SyncStats $orders, SyncStats $products, SyncStats $categories, $carts) {
        $this->contacts = $contacts;
        $this->orders = $orders;
        $this->products = $products;
        $this->categories = $categories;
        $this->carts = $carts;
    }
}

class SyncStatsRepository {
    /**
     * @return AllSyncStats
     */
    function getAllStats() {
        return new AllSyncStats(
            $this->getContactStats(),
            $this->getOrderStats(),
            $this->getProductStats(),
            $this->getCategoryStats(),
            intval(get_option("omnisend_carts_sync_count"))
        );
    }

    /**
     * @return SyncStats
     */
    private function getContactStats() {
        $synced = [
            'meta_query' => array(
                'relation' => 'OR',
                array(
                    'key' => OmnisendSync::FIELD_NAME,
                    'compare' => 'LIKE',
                    'value' => '20',
                ),
            ),
        ];

        $notSynced = [
            'meta_query' => array(
                'relation' => 'OR',
                array(
                    'key' => OmnisendSync::FIELD_NAME,
                    'compare' => 'NOT EXISTS',
                    'value' => '',
                ),
            ),
        ];

        $skipped = [
            'meta_query' => [
                'relation' => 'OR',
                [
                    'key' => OmnisendSync::FIELD_NAME,
                    'value' => OmnisendSync::STATUS_SKIPPED,
                ],
            ],
        ];

        $error = [
            'meta_query' => [
                'relation' => 'OR',
                [
                    'key' => OmnisendSync::FIELD_NAME,
                    'value' => OmnisendSync::STATUS_ERROR,
                ],
            ],
        ];

        global $wpdb;
        $sql = "SELECT COUNT(DISTINCT user_email) FROM $wpdb->users WHERE user_email != '' AND user_email IS NOT null";
        $uniqueCount = $wpdb->get_var($sql);

        return new SyncStats(
            $this->getUserCount([]),
            $uniqueCount,
            $this->getUserCount($synced),
            $this->getUserCount($notSynced),
            $this->getUserCount($skipped),
            $this->getUserCount($error)
        );
    }

    /**
     * @param array $queryParams
     * @return int
     */
    private function getUserCount($queryParams) {
        $general = [
            'count_total' => true,
            'number' => 1,
        ];

        return (new WP_User_Query(array_merge($general, $queryParams)))->get_total();
    }



    /**
     * @return SyncStats
     */
    private function getOrderStats() {
        return $this->getStatsFromPosts(POST_TYPE_SHOP_ORDER);
    }

    /**
     * @return SyncStats
     */
    private function getStatsFromPosts($postType, $postStatus = '') {
        global $wpdb;
        $syncField = OmnisendSync::FIELD_NAME;
        $syncStatusSkipped = OmnisendSync::STATUS_SKIPPED;
        $syncStatusError = OmnisendSync::STATUS_ERROR;

        $statusSql = $postStatus ? " AND post_status = '$postStatus'" : '';

        $sql = "
        SELECT 
        COUNT(ID) as total,
        SUM(IF(meta.meta_value LIKE '20%',1, 0)) as synced,
        SUM(IF(meta.meta_value IS NULL,1, 0)) as notSynced,
        SUM(IF(meta.meta_value = '$syncStatusSkipped',1, 0)) as skipped,
        SUM(IF(meta.meta_value = '$syncStatusError',1, 0)) as error
        FROM $wpdb->posts AS post
        LEFT JOIN $wpdb->postmeta AS meta ON meta.post_id = post.ID AND meta.meta_key = '$syncField'
        WHERE post_type = '$postType' $statusSql GROUP by '1';
        ";
        $info = $wpdb->get_row($sql, ARRAY_A);

        return new SyncStats(
            $this->getArrayFieldOrZero($info, 'total'),
            $this->getArrayFieldOrZero($info, 'total'),
            $this->getArrayFieldOrZero($info, 'synced'),
            $this->getArrayFieldOrZero($info, 'notSynced'),
            $this->getArrayFieldOrZero($info, 'skipped'),
            $this->getArrayFieldOrZero($info, 'error')
        );
    }

    private function getArrayFieldOrZero($array, $field) {
        return !empty($array[$field]) ? $array[$field] : 0;
    }

    /**
     * @return SyncStats
     */
    private function getProductStats() {
        return $this->getStatsFromPosts(POST_TYPE_PRODUCT, POST_STATUS_PUBLISH);
    }

    /**
     * @return SyncStats
     */
    private function getCategoryStats() {
        global $wpdb;
        $syncField = OmnisendSync::FIELD_NAME;
        $syncStatusSkipped = OmnisendSync::STATUS_SKIPPED;
        $syncStatusError = OmnisendSync::STATUS_ERROR;

        $sql = "
        SELECT
        COUNT(t.term_id) as total,
        SUM(IF(m2.meta_value LIKE '20%',1, 0)) as synced,
        SUM(IF(m2.meta_value IS NULL,1, 0)) as notSynced,
        SUM(IF(m2.meta_value = '$syncStatusSkipped',1, 0)) as skipped,
        SUM(IF(m2.meta_value = '$syncStatusError',1, 0)) as error
        FROM $wpdb->terms AS t
        LEFT JOIN $wpdb->termmeta AS m1 ON ( t.term_id = m1.term_id )
        LEFT JOIN $wpdb->termmeta AS m2 ON ( t.term_id = m2.term_id AND m2.meta_key = '$syncField' )
        INNER JOIN $wpdb->term_taxonomy AS tt ON t.term_id = tt.term_id WHERE tt.taxonomy IN ('product_cat') AND ( m1.meta_key = 'order' OR m1.meta_key IS NULL )
        GROUP by '1';
        ";
        $info = $wpdb->get_row($sql, ARRAY_A);

        return new SyncStats(
            $this->getArrayFieldOrZero($info, 'total'),
            $this->getArrayFieldOrZero($info, 'total'),
            $this->getArrayFieldOrZero($info, 'synced'),
            $this->getArrayFieldOrZero($info, 'notSynced'),
            $this->getArrayFieldOrZero($info, 'skipped'),
            $this->getArrayFieldOrZero($info, 'error')
        );
    }
}
