<?php

namespace Controller;

class IndexController extends BaseController
{
    public function indexAction()
    {
        include "View/index_template.php";
    }
}