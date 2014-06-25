<?php

namespace Core;

use Model\NewsRecord;

class Parser {

    protected $feedsDbClient;
    protected $newsDbClient;

    public function __construct(FeedsDatabaseClient $fc, NewsDatabaseClient $nc)
    {
        $this->feedsDbClient = $fc;
        $this->newsDbClient  = $nc;
    }

    public function parse()
    {
        $this->updateFeeds();
        $this->parseNewRecords();
    }

    public function updateFeeds()
    {
        $urlFileContents = file_get_contents('feeds.txt');
        $urlsArray = explode("\n", $urlFileContents);
        $urlExists = $this->feedsDbClient->getAllFeedUrlsArray();
        $newUrls = array_diff($urlsArray, $urlExists);
        $newUrls = array_diff($newUrls, array(''));

        if (count($newUrls)) {
            array_walk($newUrls, function(&$value, $key) {
                $value = str_replace(' ','',$value);
            });
            $this->feedsDbClient->addNewFeeds($newUrls);
        }
    }

    public function parseNewRecords()
    {
        $r = $this->feedsDbClient->getAllFeedsArray();

        foreach ($r as $row) {
            $url = $row['url'];
            $source = $row['id'];
            echo "<br>$url";
            //$xmldata =  file_get_contents($url);
            $structdata = simplexml_load_file($url);
            $newsArray = $structdata->channel->item;
            for ($j = 0; $j< count($newsArray); $j++) {
                $item = new NewsRecord();
                $item->setTitle($newsArray[$j]->title->__toString());
                $item->setDescription($newsArray[$j]->description->__toString());
                $pubDate = $newsArray[$j]->pubDate->__toString();
                $pubDateTimestamp = strtotime($pubDate);
                $pubDateForDB = date('Y-m-d H:i:s',$pubDateTimestamp);
                $item->setPubdate($pubDateForDB);
                $hash = hash ('md5', $item->getTitle().$item->getDescription(), false);
                $item->setHash($hash);
                $item->setSource($source);
                $this->newsDbClient->addNewsRecordIfNew($item);
            }
        }
    }
}

