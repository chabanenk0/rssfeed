<?php

// index.php is a front contoller
//require_once "Controller.php";

// registering namespaces
require_once 'Core/config.php';
require_once 'Core/bootstrap.php';

use \Controller;

$url = $_SERVER['REQUEST_URI'];

//$routes = array (
//    '/rssfeed/index/update'       => 'updateAction',
//    '/rssfeed/index/show/all'     => 'showAllAction',
//    '/rssfeed/index/show/headers' => 'showHeadersAction',
//    '/rssfeed/index/show/item'   => 'showItemsAction',
//    '/rssfeed/index/show/source'  => 'showItemsFromSourceAction',
//    '/rssfeed/index'              => 'indexAction',
//);

list($controllerName,$actionName) = sscanf($url, '/rssfeed/index/%s/%s');
$slugs = explode('/', $url);
$controllerName = $slugs[3];
$actionName = $slugs[4];
$controllerName = ucfirst($controllerName);
$controllerName = '\\Controller\\'.$controllerName.'Controller';
$actionName = strtolower($actionName);

try {
    $controller = new $controllerName($mysqlServer, $mysqlDatabaseName, $mysqlUser, $mysqlPass, $paginationLimit);
    $actionName = $actionName.'Action';
    $controller->$actionName($url);
    exit;
}
catch (Exception $e) {
    echo "401 not found";
}
//foreach ($routes as $urlRegexp=>$action) {
//    if (strncmp($url, $urlRegexp, strlen($urlRegexp))==0) {
//        $controller = new Controller();
//        $controller = new $controllerName();
//        $controller->$action($url);
//        exit;
//    }
//}
//if no matches found:

