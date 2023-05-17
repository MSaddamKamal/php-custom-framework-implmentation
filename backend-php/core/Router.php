<?php

namespace App\Core;

use App\Core\Request;

class Router
{
    /**
     * @var array[]
     */
    private $routes = [
        'POST' => [],
        'GET' => [],
    ];

    /**
     * @param $registered_routes
     * @return static
     */
    public static function initialize($registered_routes)
    {
        $router = new static;
        require $registered_routes;
        return $router;
    }

    /**
     * @param $uri
     * @param $controller_meta
     */
    public function get($uri, $controller_meta)
    {
        $this->routes['GET'][$uri] = $controller_meta;
    }

    /**
     * @param $uri
     * @param $controller_meta
     */
    public function post($uri, $controller_meta)
    {
        $this->routes['POST'][$uri] = $controller_meta;
    }

    /**
     * @param $uri
     * @param $request_type
     * @throws \Exception
     */
    public function dispatch($uri, $request_type)
    {
        if(! array_key_exists($uri,$this->routes[$request_type]))
            throw new \Exception('Route not found');

        $controller_meta = $this->routes[$request_type][$uri];
        list($controller,$action) = $controller_meta;

        $this->invokeAction($controller,$action);

    }

    /**
     * @param $controller
     * @param $action
     * @throws \Exception
     */
    public function invokeAction($controller, $action)
    {
        $controllerInstance = new $controller;
        if(!method_exists($controllerInstance,$action)){
            throw new \Exception("{$action} method Not Found");
        }

        $controllerInstance->$action(new Request());
    }
}