<?php

use App\ApplicationContext;
use App\Entity\User;
use App\Service\UserService;

class UserServiceTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * Init the mocks
     */
    public function setUp(): void
    {
        $this->userService = new UserService();
    }

    /**
     * Test that UserService compute() method return expected string with user object in $data
     */
    public function testComputeOnUserInData()
    {
        $dataToParse = "Bonjour [user:first_name] [user:last_name] dont le mail est [user:email]";
        $data['user'] = $this->getUser();

        $expected = "Bonjour Thomas Rollet dont le mail est t.rollet51@gmail.com";
        $actual = $this->userService->compute($dataToParse, $data);

        $this->assertEquals($expected, $actual);
    }

    /**
     * Test that UserService compute() method return expected string without user object in $data
     */
    public function testComputeOnUserNotInData()
    {
        $data = [];
        $dataToParse = "Bonjour [user:first_name] [user:last_name] dont le mail est [user:email]";
        ApplicationContext::getInstance()->setCurrentUser($this->getUser());

        $expected = "Bonjour Thomas Rollet dont le mail est t.rollet51@gmail.com";
        $actual = $this->userService->compute($dataToParse, $data);

        $this->assertEquals($expected, $actual);
    }

    /**
     * Test that UserService compute() method return expected string with unexpected object in $data['user']
     */
    public function testComputeOnNonUserObjectInUserDataKey()
    {
        $dataToParse = "Bonjour [user:first_name] [user:last_name] dont le mail est [user:email]";
        $data['user'] = new stdClass();

        $expected = "Bonjour Thomas Rollet dont le mail est t.rollet51@gmail.com";
        $actual = $this->userService->compute($dataToParse, $data);

        $this->assertEquals($expected, $actual);
    }

    /**
     * Get a fake User for test
     * @return User
     */
    private function getUser(): User
    {
        return new User(1, "Thomas", "Rollet", "t.rollet51@gmail.com");
    }
}