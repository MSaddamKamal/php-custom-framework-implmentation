<?php

namespace App\Core;

use App\Utils\Validation;

class Request
{
    /**
     * @var array
     */
    private array $data = [];

    /**
     * @var null
     */
    private static $instance = null;


    public function __construct()
    {
        $this->data = $_REQUEST;
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $this->data = !$_POST?json_decode(file_get_contents('php://input'), true): $_POST;
        }

        if(isset($this->data['path']))
            unset($this->data['path']);
    }

    /**
     * @return string
     */
    public static function uri()
    {
        return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    }

    /**
     * @return mixed
     */
    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * @param $attr
     * @return mixed|null
     */
    public function __get($attr)
    {
        return $this->data[$attr] ?? null;
    }

    /**
     * @param $key
     * @param $value
     */
    public function __set($key, $value)
    {
        $this->data[$key] = $value ;
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->data;
    }

    /**
     * @param $rules
     * @return bool
     */
    public function validate($rules)
    {
        foreach ($rules as $key => $rule) {
            foreach ($rule as $item => $values) {
                Validation::$item($key, $values);
            }
        }

        return count(Validation::getErrors()) == 0;
    }

    /**
     * @return bool
     */
    public function hasErrors()
    {
        return count(Validation::getErrors()) > 0;
    }

    /**
     * @return Request|null
     */
    public static function getInstance()
    {
        if(self::$instance == null)
        {
            self::$instance = new self;
        }

        return self::$instance;
    }
}