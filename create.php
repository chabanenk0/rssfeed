<?php
include 'config.php';
$pdoString = 'mysql:host='.$mysqlServer.';dbname='.$mysqlDatabaseName.';charset=utf8';
$db = new PDO($pdoString, $mysqlUser, $mysqlPass);
$db->query('create table news(id int not null auto_increment primary key,
                  title varchar (200),
                  description varchar (200),
                  source_id int,
                  pubdate DATETIME,
                  hash char (100)) default character set utf8;');
echo "<br>Creating table news:".mysql_error();
$db->query('create table feeds(id int not null auto_increment primary key,
                  url varchar (200));');

echo "<br>creating table feeds".mysql_error();

?>