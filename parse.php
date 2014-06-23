<?php

require "config.php";

mysql_connect($mysqlServer, $mysqlUser, $mysqlPass);
mysql_query('use '.$mysqlDatabaseName);

$fp = fopen ('feeds.txt', 'r');
if (!$fp) {
    die('Unable to open feeds.txt');
}
while (!feof($fp)) {
    $s = fgets($fp);
    if (strlen($s)<1) continue;
    $s = substr($s, 0, strlen($s)-1); //erase enter;
    $r = mysql_query("select id from feeds where url='$s'");

    if (mysql_num_rows($r) == 0) { //url is new
        $q = "insert into feeds (url) values ('$s')";
        mysql_query($q);
    }
}

echo "<p>updated feeds list</p>";
// requesting url's
$r = mysql_query('select * from feeds');
$n = mysql_num_rows($r);
echo("n=".$n);

for($i=0; $i<$n; $i++) {
    $f = mysql_fetch_array($r);
    $url = $f['url'];
    $source = $f['id'];
    echo "<br>$url";
    //$xmldata =  file_get_contents($url);
    $structdata = simplexml_load_file($url);
    $newsArray = $structdata->channel->item;
    for ($j = 0; $j< count($newsArray); $j++) {

        $title = $newsArray[$j]->title->__toString();
        $description = $newsArray[$j]->description->__toString();
        $pubDate = $newsArray[$j]->pubDate->__toString();
        $pubDateTimestamp = strtotime($pubDate);
        $pubDateForDB = date('Y-m-d H:i:s',$pubDateTimestamp);
        $hash = hash ('md5', $title.$description, false);
        //var_dump($title);
        //var_dump($description);
        var_dump($pubDateForDB);
        var_dump($hash);
        $r2 = mysql_query("select id from news where hash='$hash'");

        if (mysql_num_rows($r2) == 0) { //url is new
            $q = "insert into news (title, description, source, pubdate, hash)
                  values ('$title', '$description', $source, '$pubDateForDB', '$hash')";
            echo "<p>query=$q</p>";
            mysql_query($q);
        }
    }

    //var_dump($structdata);
}