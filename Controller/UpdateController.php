<?php

namespace Controller;

use Core;
use Core\FeedsDatabaseClient;
use Core\NewsDatabaseClient;
use Core\Parser;


class UpdateController extends BaseController
{
    public function updateAction()
    {
        $parser = new Parser($this->fc, $this->nc);
        $parser->parse();
        //include "parse.php";
    }
}