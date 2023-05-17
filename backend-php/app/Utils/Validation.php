<?php

namespace App\Utils;

use App\Core\Request;
use App\Models\QueryBuilder;

class Validation
{
    /**
     * @var array
     */
    private static $errors = [];

    /**
     * @param $attr
     * @param $meta
     */
    public static function required($attr, $meta)
    {
        if (is_null(Request::getInstance()->$attr) || Request::getInstance()->$attr == '') {
            self::$errors[$attr] = "$attr is required";
        }
    }

    /**
     * @param $attr
     * @param $arr
     */
    public static function inArray($attr, $arr)
    {
        if (!in_array(Request::getInstance()->$attr,$arr)) {
            self::$errors[$attr] = "invalid $attr attribute";
        }
    }

    /**
     * @param $attr
     * @param $table
     */
    public static function unique($attr, $table)
    {
        $builder = new QueryBuilder();

        $result = $builder->findByAttr($table,$attr,Request::getInstance()->$attr);
        ;
        if (count($result) > 0) {
            self::$errors[$attr] = "$attr already exists";
        }
    }

    /**
     * @param $attr
     * @param $meta
     */
    public static function regular_expression($attr, $meta)
    {
        if (!preg_match($meta, Request::getInstance()->$attr)) {
            self::$errors[$attr] = "$attr must contain only characters and spaces";
        }
    }

    /**
     * @param $attr
     * @param $meta
     */
    public static function numeric($attr, $meta)
    {
        if (!is_numeric(Request::getInstance()->$attr)) {
            self::$errors[$attr] = "$attr must contain only digits";
        }
    }

    /**
     * @return array
     */
    public static function getErrors()
    {
        return self::$errors;
    }
}