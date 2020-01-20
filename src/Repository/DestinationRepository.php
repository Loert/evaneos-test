<?php

namespace App\Repository;

use App\Entity\Destination;
use App\Helper\SingletonTrait;
use Faker;

/**
 * Class DestinationRepository
 */
class DestinationRepository implements Repository
{
    use SingletonTrait;

    /**
     * @param int $id
     *
     * @return Destination
     */
    public function getById($id): Destination
    {
        // DO NOT MODIFY THIS METHOD

        $faker = Faker\Factory::create();
        $faker->seed($id);

        return new Destination(
            $id,
            $faker->country,
            'en',
            $faker->slug()
        );
    }
}
