<?php

use App\Entity\Destination;
use App\Repository\DestinationRepository;

class DestinationRepositoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var DestinationRepository
     */
    private $destinationRepository;

    /**
     * Init the mocks
     */
    public function setUp(): void
    {
        $this->destinationRepository = new DestinationRepository();
    }

    /**
     * Test that DestinationRepository getById() method return an instance of Quote
     */
    public function testGetByIdOnSuccess()
    {
        $actual = $this->destinationRepository->getById(1);
        $this->assertInstanceOf(Destination::class, $actual);
    }
}