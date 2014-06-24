<?php

require "config.php";

$pdoString = 'mysql:host='.$mysqlServer.';dbname='.$mysqlDatabaseName.';charset=utf8';
$db = new PDO($pdoString, $mysqlUser, $mysqlPass);

$fp = fopen ('feeds.txt', 'r');
if (!$fp) {
    die('Unable to open feeds.txt');
}
while (!feof($fp)) {
    $s = fgets($fp);
    if (strlen($s)<1) continue;
    $s = substr($s, 0, strlen($s)-1); //erase enter;
    $r = $db->query("select id from feeds where url='$s'");

    if ($r->rowCount() == 0) { //url is new
        $q = "insert into feeds (url) values ('$s')";
        $db->query($q);
    }
}

echo "<p>updated feeds list</p>";
// requesting url's
$r = $db->query('select * from feeds');

foreach ($r as $row) {
    $url = $row['url'];
    $source = $row['id'];
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
        //var_dump($pubDateForDB);
        //var_dump($hash);
        $r2 = $db->query("select id from news where hash='$hash'");

        if ($r2->rowCount() == 0) { //url is new
            $q = "insert into news (title, description, source_id, pubdate, hash)
                  values (:title, :description, :source, :pubDateForDB, :hash)";
            //values ('$title', '$description', $source, '$pubDateForDB', '$hash')";
            //echo "<p>query=$q</p>";
            $stmt =  $db->prepare($q);
            try {
                $res = $stmt->execute(array(
                    ':title' => $title,
                    ':description' => $description,
                    ':source_id' => $source,
                    ':pubDateForDB' => $pubDateForDB,
                    ':hash' => $hash));
            }
            catch (PDOException $ex) {
                echo "!!! exception";
                echo $ex->getMessage();
            }
            //var_dump($res);
        }
    }

    //var_dump($structdata);
}