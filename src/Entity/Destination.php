<?php

/**
 * Class Destination
 */
class Destination
{
    public $id;
    public $countryName;
    public $conjunction;
    public $name;
    public $computerName;

    /**
     * Destination constructor.
     * @param $id
     * @param $countryName
     * @param $conjunction
     * @param $computerName
     */
    public function __construct($id, $countryName, $conjunction, $computerName)
    {
        $this->id = $id;
        $this->countryName = $countryName;
        $this->conjunction = $conjunction;
        $this->computerName = $computerName;
    }
}
