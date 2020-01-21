<?php

namespace App\Repository;

use Faker\Factory;
use App\Helper\SingletonTrait;
use App\Entity\Quote;

/**
 * Class QuoteRepository
 */
class QuoteRepository implements Repository
{
    use SingletonTrait;

    /**
     * @param int $id
     *
     * @return Quote
     */
    public function getById($id): Quote
    {
        $generator = Factory::create();
        $generator->seed($id);
        return new Quote(
            $id,
            $generator->numberBetween(1, 10),
            $generator->numberBetween(1, 200),
            $generator->dateTime()
        );
    }
}
