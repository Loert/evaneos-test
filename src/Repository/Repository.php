<?php

namespace App\Repository;

/**
 * Interface Repository
 */
interface Repository
{
    /**
     * @param $id
     * @return mixed
     */
    public function getById($id);
}
