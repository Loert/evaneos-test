<?php

namespace App\Helper;

/**
 * Trait SingletonTrait
 */
trait SingletonTrait
{
    /**
     * @var $this
     */
    protected static $instance = null;

    /**
     * @return $this
     */
    public static function getInstance(): self
    {
        if (!self::$instance) {
            self::$instance = new static();
        }

        return self::$instance;
    }
}
