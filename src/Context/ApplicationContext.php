<?php

namespace App;

use Faker\Factory;
use App\Helper\SingletonTrait;
use App\Entity\Site;
use App\Entity\User;

/**
 * Class ApplicationContext
 */
class ApplicationContext
{
    use SingletonTrait;

    /**
     * @var Site
     */
    private $currentSite;
    /**
     * @var User
     */
    private $currentUser;

    /**
     * ApplicationContext constructor.
     */
    protected function __construct()
    {
        $faker = Factory::create();
        $this->currentSite = new Site($faker->randomNumber(), $faker->url);
        $this->currentUser = new User($faker->randomNumber(), $faker->firstName, $faker->lastName, $faker->email);
    }

    /**
     * @return Site
     */
    public function getCurrentSite(): Site
    {
        return $this->currentSite;
    }

    /**
     * @return User
     */
    public function getCurrentUser(): User
    {
        return $this->currentUser;
    }

    /**
     * @param User $user
     */
    public function setCurrentUser(User $user): void
    {
        $this->currentUser = $user;
    }
}
