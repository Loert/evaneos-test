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
        if (isset($data['user']) && $data['user'] instanceof User) {
            $user = $data['user'];
        } else {
            $user = $this->applicationContext->getCurrentUser();
        }

        $text = $this->replace($text, $user);

        return $text;
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
}