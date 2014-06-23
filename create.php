<?php
include 'config.php';
mysql_connect($mysqlServer, $mysqlUser, $mysqlPass);

mysql_query('use rssfeed;');
mysql_query('create table news(id int not null auto_increment primary key,
                  title varchar (200),
                  content varchar (200),
                  source int,
                  date DATETIME);');
echo "a".mysql_error();

?>