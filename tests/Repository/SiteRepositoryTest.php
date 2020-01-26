<?php

use App\Entity\Site;
use App\Repository\SiteRepository;

class SiteRepositoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var SiteRepository
     */
    private $siteRepository;

    /**
     * Init the mocks
     */
    public function setUp(): void
    {
        $this->siteRepository = new SiteRepository();
    }

    /**
     * Test that SiteRepository getById() method return an instance of Quote
     */
    public function testGetByIdOnSuccess()
    {
        $actual = $this->siteRepository->getById(1);
        $this->assertInstanceOf(Site::class, $actual);
    }
}