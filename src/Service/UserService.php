<?php

namespace App\Service;

use App\Entity\Quote;
use App\Entity\User;
use App\Repository\DestinationRepository;
use App\Repository\SiteRepository;

/**
 * Class UserService
 * @package App\Service
 */
class UserService extends AbstractService
{
    /**
     * QuoteService constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param string $text
     * @param array $data
     * @return string
     */
    public function compute(string $text, array $data): string
    {
        $user = $this->getUser($data);

        return $this->replace($text, $user);
    }

    /**
     * @param string $text
     * @param User $user
     * @return string
     */
    protected function replace(string $text, $user): string
    {
        $text = $this->replaceText('[user:first_name]', $user->getFirstname(), $text);

        return $text;
    }

    /**
     * @param array $data
     * @return User
     */
    private function getUser(array $data): User
    {
        if (isset($data['user']) && $data['user'] instanceof User) {
            return $data['user'];
        } else {
            return $this->applicationContext->getCurrentUser();
        }
    }
}