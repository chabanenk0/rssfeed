<?php
/**
 * Created by PhpStorm.
 * User: dmitrychabanenko
 * Date: 6/23/14
 * Time: 5:05 PM
 */

require "config.php";
require "NewsRecord.php";

if (array_key_exists('offset', $_REQUEST)) {
    $offset = (int) $_REQUEST['offset'];
} else {
    $offset = 0;
}
$limit =  $paginationLimit;

$pdoString = 'mysql:host='.$mysqlServer.';dbname='.$mysqlDatabaseName.';charset=utf8';
$db = new PDO($pdoString, $mysqlUser, $mysqlPass);

$r = $db->query('select id from news');

$numberOfRecords = $r->rowCount();

$stmt = $db->prepare('select * from news limit :limit offset :offset');
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$r = $stmt->fetchAll();



$recordsArray=array();

foreach ($r as $row) {
    $record = new NewsRecord();
    $record->setTitle($row['title']);
    $record->setDescription($row['description']);
    $record->setSource($row['source']);
    $record->setPubdate($row['pubdate']);
    array_push($recordsArray, $record);
}

include "list_template.php";
