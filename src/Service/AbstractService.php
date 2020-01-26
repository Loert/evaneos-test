<?php

namespace App\Service;

/**
 * Class AbstractService
 * @package App\Service
 */
abstract class AbstractService {

    /**
     * @param string $text
     * @param array $data
     * @return string
     */
    public abstract function compute(string $text, array $data): string;

    /**
     * @param string $text
     * @param $object
     * @return string
     */
    public abstract function replace(string $text, $object): string;

    /**
     * @param string $key
     * @param string $value
     * @param $text
     * @return string
     */
    protected function replaceText(string $key, string $value, string $text): string
    {
        if (strpos($text, $key) !== false && $text !== null && strlen($text) > 0) {
            $text = str_replace($key, $value, $text);
        }

        return $text;
    }
}