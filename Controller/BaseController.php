<?php

namespace Controller;

use Core\FeedsDatabaseClient;
use Core\NewsDatabaseClient;
use Model\NewsRecord;

class BaseController
{
    //FeedsDatabaseClient
    protected $fc;

    //NewsDatabaseClient
    protected $nc;

    public function __construct($mysqlServer, $mysqlDatabaseName, $mysqlUser, $mysqlPass, $paginationLimit)
    {
        $this->fc = new FeedsDatabaseClient($mysqlServer, $mysqlDatabaseName, $mysqlUser, $mysqlPass);
        $this->nc = new NewsDatabaseClient ($mysqlServer, $mysqlDatabaseName, $mysqlUser, $mysqlPass);
        $this->paginationLimit = $paginationLimit;
    }
}

