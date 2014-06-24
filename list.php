<?php
/**
 * Created by PhpStorm.
 * User: dmitrychabanenko
 * Date: 6/23/14
 * Time: 5:05 PM
 */

require "config.php";
require "NewsRecord.php";

if (array_key_exists('page', $_REQUEST)) {
    $pageNumber = (int) $_REQUEST['page']-1;
} else {
    $pageNumber = 0;
}

$limit =  $paginationLimit;
$offset = $pageNumber*$limit;

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
    $record->setSource($row['source_id']);
    $record->setPubdate($row['pubdate']);
    array_push($recordsArray, $record);
}

// calculating variables for pagination
$maxPossiblePage = round($numberOfRecords/$paginationLimit);

$minPageNumber =  max(1, $pageNumber - 1);
$maxPageNumber =  min($maxPossiblePage, $pageNumber + 3);
if ($pageNumber < 3) {
    $maxPageNumber = min($maxPossiblePage, 5);
}
if ($pageNumber > $maxPossiblePage - 3) {
    $minPageNumber = max($maxPossiblePage - 4, 1);
}

include "list_template.php";
