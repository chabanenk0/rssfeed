<?php

// index.php is a front contoller
//require_once "Controller.php";

// registering namespaces
require_once 'Core/config.php';
require_once 'Core/bootstrap.php';

use \Controller;

$url = $_SERVER['REQUEST_URI'];

list($controllerName,$actionName) = sscanf($url, '/rssfeed/index/%s/%s');
$slugs = explode('/', $url);
if (array_key_exists(3,$slugs)){
    $controllerName = $slugs[3];
} else {
    $controllerName='index';
}
if (array_key_exists(4,$slugs)){
    $actionName = $slugs[4];
} else {
    $actionName='index';
}
$controllerName = ucfirst($controllerName);
$controllerName = '\\Controller\\'.$controllerName.'Controller';
$actionName = strtolower($actionName);

if (class_exists($controllerName, true)) {
    $controller = new $controllerName($mysqlServer, $mysqlDatabaseName, $mysqlUser, $mysqlPass, $paginationLimit);
    $actionName = $actionName.'Action';
    $controller->$actionName($url);
    exit;
} else {
    header('HTTP/1.1 404 Not Found');
    echo "404 not found";
}
