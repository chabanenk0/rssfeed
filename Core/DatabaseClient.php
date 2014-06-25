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
}
