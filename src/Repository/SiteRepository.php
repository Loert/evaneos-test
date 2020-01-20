<?php

namespace App\Repository;

use App\Helper\SingletonTrait;
use Faker;
use App\Entity\Site;

/**
 * Class SiteRepository
 */
class SiteRepository implements Repository
{
    use SingletonTrait;

    /**
     * @param int $id
     *
     * @return Site
     */
    public function getById($id): Site
    {
        // DO NOT MODIFY THIS METHOD
        $faker = Faker\Factory::create();
        $faker->seed($id);
        return new Site($id, $faker->url);
    }
}
