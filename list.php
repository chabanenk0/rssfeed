<?php
/**
 * Created by PhpStorm.
 * User: dmitrychabanenko
 * Date: 6/23/14
 * Time: 5:05 PM
 */

require "config.php";

mysql_connect($mysqlServer, $mysqlUser, $mysqlPass);
mysql_query('use '.$mysqlDatabaseName);

$r = mysql_query('select * from news');
$n = mysql_num_rows($r);
echo "<table border=1>";
echo "<tr>\n<th>title</th><th>description</th><th>source</th><th>pubdate</th></tr>";
for($i = 0; $i < $n; $i++) {
    $f = mysql_fetch_array($r);
    $title = $f['title'];
    $description = $f['description'];
    $source = $f['source'];
    $pubdate = $f['pubdate'];
    echo "<tr>\n";
    echo "<td>$title</td>\n";
    echo "<td>$description</td>\n";
    echo "<td>$source</td>\n";
    echo "<td>$pubdate</td>\n";
}

echo "</table>";