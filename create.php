<?php
include 'config.php';
mysql_connect($mysqlServer, $mysqlUser, $mysqlPass);

mysql_query('use '.$mysqlDatabaseName);
mysql_query('create table news(id int not null auto_increment primary key,
                  title varchar (200),
                  description varchar (200),
                  source int,
                  pubdate DATETIME,
                  hash char (100));');
echo "<br>Creating table news:".mysql_error();
mysql_query('create table feeds(id int not null auto_increment primary key,
                  url varchar (200));');

echo "<br>creating table feeds".mysql_error();

?>