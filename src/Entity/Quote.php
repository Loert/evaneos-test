<?php

namespace App\Entity;

/**
 * Class Quote
 */
class Quote
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var int
     */
    public $siteId;

    /**
     * @var int
     */
    public $destinationId;

    public $dateQuoted;

    /**
     * Quote constructor.
     * @param $id
     * @param $siteId
     * @param $destinationId
     * @param $dateQuoted
     */
    public function __construct(int $id, int $siteId, int $destinationId, $dateQuoted)
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

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Quote
     */
    public function setId(int $id): Quote
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getSiteId(): int
    {
        return $this->siteId;
    }

    /**
     * @param int $siteId
     * @return Quote
     */
    public function setSiteId(int $siteId): Quote
    {
        $this->siteId = $siteId;
        return $this;
    }

    /**
     * @return int
     */
    public function getDestinationId(): int
    {
        return $this->destinationId;
    }

    /**
     * @param int $destinationId
     * @return Quote
     */
    public function setDestinationId(int $destinationId): Quote
    {
        $this->destinationId = $destinationId;
        return $this;
    }
}
