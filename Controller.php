<?php
/**
 * Created by PhpStorm.
 * User: dmitrychabanenko
 * Date: 6/24/14
 * Time: 4:03 PM
 */
//     actions:
//    '$/index/update'   => 'updateAction',
//    '$/index/show/all' => 'showAllAction',
//    '$/index/show/headers' => 'showHeadersAction',
//    '$/index/show/item' => 'showItemsAction',
//    '$/index/show/source' => 'showItemsFromSourceAction',

class Controller
{
    public function indexAction()
    {
        include "index_template.php";
    }

    public function updateAction()
    {
        include "parse.php";
    }

    public function showAllAction()
    {
        $where = '';
        include "list.php";
    }

    public function showHeadersAction()
    {
        $where = '';
        $outputTemplate = 'headers_template.php';
        include "list.php";
    }

    public function showItemsAction()
    {
        include "show_one.php";
    }

    public function showItemsFromSourceAction($url)
    {
        list($source_id)=sscanf($url, '/rssfeed/index/show/source/%d/');
        $where = ' where source_id='.$source_id;
        include "list.php";
    }
}