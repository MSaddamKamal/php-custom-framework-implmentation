<?php

namespace App\Core\Database;

use PDO;
use PDOException;

class Connection
{
    /**
     * @var null
     */
    private static $instance = null;

    // "static" makes a method available globally without requiring an instance.

    /**
     * @param $db
     * @return void|null
     */
    public static function make($db)
    {
        if(static::$instance){
            return static::$instance;
        }

        try {
            // PDO requires (1) DSN (Data Source Name), (2) username, and (3) password.
            // Fourth argument may include "options":
            static::$instance = new PDO(
                "{$db['connection']};dbname={$db['name']}",
                $db['username'],
                $db['password'],
                $db['options']
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return static::$instance;
    }
}

