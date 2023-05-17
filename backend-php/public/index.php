<?php


use App\Core\Router;
use App\Core\Request;

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/

require __DIR__ . '/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Bootstraping application's required classes
|
*/

$app = require __DIR__ . '/../core/bootstrap.php';

/*
|--------------------------------------------------------------------------
| Handling Request
|--------------------------------------------------------------------------
|
| Initialize Router to load all the routes and handle the request.
| the router will direct the request to appropriate controller for further consideration
*/


Router::initialize('../app/routes/api.php')->dispatch(Request::uri(),Request::method());


