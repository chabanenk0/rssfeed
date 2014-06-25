<?php

namespace Controller;

use Core;
use Core\FeedsDatabaseClient;
use Core\NewsDatabaseClient;
use Core\Parser;


class UpdateController
{
    //FeedsDatabaseClient
    protected $fc;

    //NewsDatabaseClient
    protected $nc;

    public function __construct($mysqlServer, $mysqlDatabaseName, $mysqlUser, $mysqlPass)
    {
        $this->fc = new FeedsDatabaseClient($mysqlServer, $mysqlDatabaseName, $mysqlUser, $mysqlPass);
        $this->nc = new NewsDatabaseClient ($mysqlServer, $mysqlDatabaseName, $mysqlUser, $mysqlPass);
    }

    public function updateAction()
    {
        $parser = new Parser($this->fc, $this->nc);
        $parser->parse();
        //include "parse.php";
    }
}