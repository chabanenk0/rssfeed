<?php

namespace Controller;

use Core\FeedsDatabaseClient;
use Core\NewsDatabaseClient;
use Model\NewsRecord;

class ShowController
{
    //FeedsDatabaseClient
    protected $fc;

    //NewsDatabaseClient
    protected $nc;

    protected $where='';

    protected $paginationLimit = 10;

    public function __construct($mysqlServer, $mysqlDatabaseName, $mysqlUser, $mysqlPass, $paginationLimit)
    {
        $this->fc = new FeedsDatabaseClient($mysqlServer, $mysqlDatabaseName, $mysqlUser, $mysqlPass);
        $this->nc = new NewsDatabaseClient ($mysqlServer, $mysqlDatabaseName, $mysqlUser, $mysqlPass);
        $this->paginationLimit = $paginationLimit;
    }

    private function getCurrentPageNumber()
    {
        if (array_key_exists('page', $_REQUEST)) {
            return (int) $_REQUEST['page']-1;
        } else {
            return 0;
        }
    }

    private function getNumberOfRecords()
    {
        return $this->nc->getNumberOfNewsRecords($this->where);


    }

    private function getMinPageNumber()
    {
        $maxPossiblePage = $this->getMaxPossiblePage();
        $pageNumber =  $this->getCurrentPageNumber();
        $minPageNumber =  max(1, $pageNumber - 1);
        if ($pageNumber > $maxPossiblePage - 3) {
            $minPageNumber = max($maxPossiblePage - 4, 1);
        }

        return $minPageNumber;
    }

    public function getMaxPossiblePage()
    {
        $numberOfRecords = $this->getNumberOfRecords();

        return round($numberOfRecords/$this->paginationLimit);
    }

    private function getMaxPageNumber()
    {
        $maxPossiblePage = $this->getMaxPossiblePage();
        $pageNumber =  $this->getCurrentPageNumber();
        $maxPageNumber =  min($maxPossiblePage, $pageNumber + 3);
        if ($pageNumber < 3) {
            $maxPageNumber = min($maxPossiblePage, 5);
        }

        return $maxPageNumber;
    }

    public function showAction($url, $template)
    {
        $this->url = $url;
        $this->where = '';
        $minPageNumber = $this->getMinPageNumber();
        $maxPageNumber = $this->getMaxPageNumber();
        $pageNumber = $this->getCurrentPageNumber();
        $limit = $this->paginationLimit;
        $offset = $limit* $pageNumber;
        $recordsArray = $this->nc->getNewsRecords($this->where, $limit, $offset);
        $maxPossiblePage = $this->getMaxPossiblePage();
        include $template;
    }

    public function showallAction($url)
    {
        $this->where = '';
        $this->showAction($url, "View/list_template.php");
    }

    public function showHeadersAction($url)
    {
        $this->where = '';
        $this->showAction($url, "View/headers_template.php");
    }

    public function showItemsAction()
    {
        include "show_one.php";
    }

    public function showitemsfromsourceAction($url)
    {
        list($source_id)=sscanf($url, '/rssfeed/index/Controller/showItemsFromSource/%d/');
        $this->where = ' where source_id='.$source_id;
        $this->showAction($url, "View/list_template.php");
    }
}

