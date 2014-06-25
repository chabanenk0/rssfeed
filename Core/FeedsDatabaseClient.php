<?php

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

    public function getFeedUrlById($id)
    {
        $r = $this->db->query('select url from feeds where id='.$id);
        $r->Execute();
        $urlExists = $r->fetchAll(\PDO::FETCH_COLUMN, 0);

        return $urlExists[0];
    }
}
