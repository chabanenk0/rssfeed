<?php
/**
 * Created by PhpStorm.
 * User: dmitrychabanenko
 * Date: 6/23/14
 * Time: 5:05 PM
 */


require_once 'config.php';
require_once 'NewsRecord.php';

$pdoString = 'mysql:host='.$mysqlServer.';dbname='.$mysqlDatabaseName.';charset=utf8';
$db = new PDO($pdoString, $mysqlUser, $mysqlPass);

$itemId = $_REQUEST['id'];

$r = $db->query('select * from news where id='.$itemId);

if ($r->rowCount() < 1) {
    die ("Cannot find the item $itemId");
}

foreach ($r as $row) {
    $record = new NewsRecord();
    $record->setId($row['id']);
    $record->setTitle($row['title']);
    $record->setDescription($row['description']);
    $record->setSource($row['source_id']);
    $record->setPubdate($row['pubdate']);
}

$r = $db->query('select * from feeds where id='.$record->getSource());

if ($r->rowCount() < 1) {
    $sourceName = 'undefined';
    $sourceId   = -1;
} else {
    foreach ($r as $row) {
        $sourceName = $row['url'];
        $sourceId   = $row['id'];
    }
}
echo $sourceName;


include ('show_one_template.php');
