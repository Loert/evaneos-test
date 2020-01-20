<?php

/**
 * Class User
 */
class User
{
    public $id;
    public $firstname;
    public $lastname;
    public $email;

    /**
     * User constructor.
     * @param $id
     * @param $firstname
     * @param $lastname
     * @param $email
     */
    public function __construct($id, $firstname, $lastname, $email)
    {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
    }
}
