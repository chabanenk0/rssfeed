<?php
/**
 * Created by PhpStorm.
 * User: dmitrychabanenko
 * Date: 6/23/14
 * Time: 5:05 PM
 */

require "config.php";

$pdoString = 'mysql:host='.$mysqlServer.';dbname='.$mysqlDatabaseName.';charset=utf8';
$db = new PDO($pdoString, $mysqlUser, $mysqlPass);

$r = $db->query('select * from news');
echo "<table border=1>";
echo "<tr>\n<th>title</th><th>description</th><th>source</th><th>pubdate</th></tr>";
foreach ($r as $row) {
    $title = $row['title'];
    $description = $row['description'];
    $source = $row['source'];
    $pubdate = $row['pubdate'];
    echo "<tr>\n";
    echo "<td>$title</td>\n";
    echo "<td>$description</td>\n";
    echo "<td>$source</td>\n";
    echo "<td>$pubdate</td>\n";
}

echo "</table>";