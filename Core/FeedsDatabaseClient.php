<?php
/**
 * Created by PhpStorm.
 * User: dmitrychabanenko
 * Date: 6/25/14
 * Time: 4:20 PM
 */

namespace Core;


class FeedsDatabaseClient extends DatabaseClient
{
    public function getAllFeedUrlsArray()
    {
        $r = $this->db->query("select url from feeds");
        $r->Execute();
        $urlExists = $r->fetchAll(\PDO::FETCH_COLUMN, 0);

        return $urlExists;
    }

    public function getAllFeedsArray()
    {
        $r = $this->db->query("select * from feeds");
        $r->Execute();
        $urlExists = $r->fetchAll();

        return $urlExists;
    }

    public function addNewFeeds ($feedUrlsArray)
    {
        $query = 'insert into feeds (url) values (\'';
        $query = $query . implode('\',\'', $feedUrlsArray) . '\')';
        $this->db->query($query);
    }
}
