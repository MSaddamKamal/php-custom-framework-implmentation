<?php

use App\Core\Database\Connection;
use App\Core\Response\Response;
use App\Core\App;

// Creates a key called "config" which has the config.php array as its value,
// and then stores the key-value pair within the App DI container:
App::bind('config', require '../config.php');

// helpers , it can be in a seperate file as well
/**
 * @return Response
 */
function response(){
    return new Response;
}

/**
 * @return PDO
 */
function getConnection(){
    return  Connection::make(App::get('config')['database']);
}