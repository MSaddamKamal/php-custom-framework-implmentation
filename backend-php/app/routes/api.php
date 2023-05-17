<?php

use App\Http\Controllers\ProductController;

$routes_api_prefix = 'api/v1/';

$router->get("{$routes_api_prefix}product/get", [ProductController::class,'index']);
$router->post("{$routes_api_prefix}product/add", [ProductController::class,'store']);
$router->post("{$routes_api_prefix}product/deleteAll", [ProductController::class,'deleteAll']);