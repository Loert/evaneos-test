<?php

/**
 * Class Quote
 */
class Quote
{
    public $id;
    public $siteId;
    public $destinationId;
    public $dateQuoted;

    /**
     * Quote constructor.
     * @param $id
     * @param $siteId
     * @param $destinationId
     * @param $dateQuoted
     */
    public function __construct($id, $siteId, $destinationId, $dateQuoted)
    {
        $this->id = $id;
        $this->siteId = $siteId;
        $this->destinationId = $destinationId;
        $this->dateQuoted = $dateQuoted;
    }

    /**
     * @param Quote $quote
     * @return string
     */
    public static function renderHtml(Quote $quote): string
    {
        return '<p>' . $quote->id . '</p>';
    }

    /**
     * @param Quote $quote
     * @return string
     */
    public static function renderText(Quote $quote): string
    {
        return (string) $quote->id;
    }
}