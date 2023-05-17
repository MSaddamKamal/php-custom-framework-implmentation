<?php

namespace App\Core;

// Basic dependency injection container.  Acts as a place to bind dependencies
// that have been sent to it (essentially, a registry).  When you need to fetch
// those values, you can later retrieve them from the container.
class App
{
    /**
     * @var array
     */
    protected static $registry = [];

    /**
     * @param $key
     * @param $value
     */
    public static function bind($key, $value)
    {
        static::$registry[$key] = $value;
    }

    /**
     * @param $key
     * @return mixed
     */
    public static function get($key)
    {
        if (!array_key_exists($key, static::$registry)) {
            throw new Exception("No {$key} is bound in the container.");
        }
        return static::$registry[$key];
    }
}
