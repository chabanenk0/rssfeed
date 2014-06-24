<?php
/**
 * Created by PhpStorm.
 * User: dmitrychabanenko
 * Date: 6/24/14
 * Time: 2:08 PM
 */

// index.php is a front contoller
require_once "Controller.php";

$url = $_SERVER['REQUEST_URI'];

$routes = array (
    '/rssfeed/index/update'       => 'updateAction',
    '/rssfeed/index/show/all'     => 'showAllAction',
    '/rssfeed/index/show/headers' => 'showHeadersAction',
    '/rssfeed/index/show/item'   => 'showItemsAction',
    '/rssfeed/index/show/source'  => 'showItemsFromSourceAction',
    '/rssfeed/index'              => 'indexAction',
);

$controller = new Controller();
foreach ($routes as $urlRegexp=>$action) {
    if (strncmp($url, $urlRegexp, strlen($urlRegexp))==0) {
        $controller->$action($url);
        exit;
    }
}
//if no matches found:
echo "401 not found";
