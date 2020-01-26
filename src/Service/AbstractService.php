<?php

namespace App\Service;

use App\ApplicationContext;

/**
 * Class AbstractService
 * @package App\Service
 */
abstract class AbstractService
{

    /**
     * @var ApplicationContext
     */
    protected $applicationContext;

    /**
     * AbstractService constructor.
     */
    public function __construct()
    {
        $this->applicationContext = ApplicationContext::getInstance();
    }

    /**
     * @param string $text
     * @param array $data
     * @return string
     */
    abstract public function compute(string $text, array $data): string;

    /**
     * @param string $text
     * @param $entity
     * @return string
     */
    abstract protected function replace(string $text, $entity): string;

    /**
     * @param string $key
     * @param string $value
     * @param $text
     * @return string
     */
    protected function replaceText(string $key, string $value, string $text): string
    {
        if ($text !== null && strlen($text) > 0 && strpos($text, $key) !== false) {
            $text = str_replace($key, $value, $text);
        }
        return $text;
    }
}
