<?php

use App\Entity\Quote;
use App\Repository\QuoteRepository;

class QuoteRepositoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var QuoteRepository
     */
    private $quoteRepository;

    /**
     * Init the mocks
     */
    public function setUp(): void
    {
        $this->quoteRepository = new QuoteRepository();
    }

    /**
     * Test that QuoteRepository getById() method return an instance of Quote
     */
    public function testGetByIdOnSuccess()
    {
        $actual = $this->quoteRepository->getById(1);
        $this->assertInstanceOf(Quote::class, $actual);
    }
}