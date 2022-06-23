<?php
if (!defined('ABSPATH')) {
    exit;
}

class OmnisendCategory
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $title;

    /**
     * @param int $id
     *
     * @return OmnisendCategory|null
     */
    public static function createFromId($id)
    {
        try {
            // https://developer.wordpress.org/reference/functions/get_term/
            $term = get_term($id);
            $title = $term && is_object($term) && property_exists($term, 'name') ? $term->name : '';

            return new OmnisendCategory($id, $title);
        } catch (OmnisendEmptyRequiredFieldsException $exception) {
            return null;
        }
    }

    public function toArray() {
        return [
            'categoryID' => $this->id,
            'title'      => $this->title,
        ];
    }

    /**
     * @throws OmnisendEmptyRequiredFieldsException
     */
    private function __construct($id, $title)
    {
        $this->id = (string) $id;
        $this->title = $title;

        if (empty($this->id) || empty($this->title)) {
            throw new OmnisendEmptyRequiredFieldsException();
        }
    }

}
