<?php
/**
 * Created by PhpStorm.
 * User: dmitrychabanenko
 * Date: 6/25/14
 * Time: 4:20 PM
 */

namespace Core;

class DatabaseClient
{

    protected $db;

    public function __construct($mysqlServer, $mysqlDatabaseName, $mysqlUser, $mysqlPass)
    {
        $pdoString = 'mysql:host='.$mysqlServer.';dbname='.$mysqlDatabaseName.';charset=utf8';
        $this->db =  new \PDO($pdoString, $mysqlUser, $mysqlPass);
    }

    public function createDatabase()
    {
        $this->db->query('create table news(id int not null auto_increment primary key,
                  title varchar (200),
                  description varchar (200),
                  source_id int,
                  pubdate DATETIME,
                  hash char (100)) default character set utf8;');
        $this->db->query('create table feeds(id int not null auto_increment primary key,
                  url varchar (200));');
    }
}
