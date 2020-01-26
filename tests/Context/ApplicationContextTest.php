<?php

use App\ApplicationContext;
use App\Entity\Site;
use App\Entity\User;

class ApplicationContextTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ApplicationContext
     */
    private $applicationContext;

    /**
     * Init the mocks
     */
    public function setUp(): void
    {
        $this->applicationContext = ApplicationContext::getInstance();
    }

    /**
     * Closes the mocks
     */
    public function tearDown(): void
    {
    }

    /**
     * Test that ApplicationContext getCurrentSite() method return an instance of Site
     */
    public function testGetCurrentSite()
    {
        $actual = $this->applicationContext->getCurrentSite();
        $this->assertInstanceOf(Site::class, $actual);
    }

    /**
     * Test that ApplicationContext getCurrentUser() method return an instance of User
     */
    public function testGetCurrentUser()
    {
        $actual = $this->applicationContext->getCurrentUser();
        $this->assertInstanceOf(User::class, $actual);
    }
}