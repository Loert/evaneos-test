<?php

namespace App\Service;

use App\Entity\Quote;
use App\Repository\DestinationRepository;
use App\Repository\SiteRepository;

/**
 * Class QuoteService
 * @package App\Service
 */
class QuoteService extends AbstractService
{
    /**
     * @var DestinationRepository
     */
    private $destinationRepository;

    /**
     * @var SiteRepository
     */
    private $siteRepository;

    /**
     * QuoteService constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->destinationRepository = new DestinationRepository();
        $this->siteRepository = new SiteRepository();
    }

    /**
     * @param string $text
     * @param array $data
     * @return string
     */
    public function compute(string $text, array $data): string
    {
        if (isset($data['quote']) && $data['quote'] instanceof Quote) {
            $text = $this->replace($text, $data['quote']);
        }

        return $text;
    }

    /**
     * @param string $text
     * @param Quote $quote
     * @return string
     */
    protected function replace(string $text, $quote): string
    {
        $destination = $this->destinationRepository->getById($quote->destinationId);
        $site = $this->siteRepository->getById($quote->siteId);

        $text = $this->replaceText('[quote:summary_html]', Quote::renderHtml($quote), $text);
        $text = $this->replaceText('[quote:summary]', Quote::renderText($quote), $text);
        $text = $this->replaceText('[quote:destination_name]', $destination->countryName, $text);

        //Format destination link (move to another method ?)
        $destinationLink = vsprintf('%s/%s/quote/%d', [$site->url, $destination->countryName, $quote->id]);
        $text = $this->replaceText('[quote:destination_link]', $destinationLink, $text);

        return $text;
    }
}