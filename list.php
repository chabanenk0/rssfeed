<?php
/**
 * Created by PhpStorm.
 * User: dmitrychabanenko
 * Date: 6/23/14
 * Time: 5:05 PM
 */

require "config.php";
require "NewsRecord.php";

$pdoString = 'mysql:host='.$mysqlServer.';dbname='.$mysqlDatabaseName.';charset=utf8';
$db = new PDO($pdoString, $mysqlUser, $mysqlPass);

$r = $db->query('select * from news');
//echo "<table border=1>";
//echo "<tr>\n<th>title</th><th>description</th><th>source</th><th>pubdate</th></tr>";

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
