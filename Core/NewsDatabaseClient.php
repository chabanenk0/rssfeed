<?php

namespace Core;

use Model\NewsRecord;

class NewsDatabaseClient extends DatabaseClient
{
    private  function isNewsRecordInDatabase(NewsRecord $r)
    {
        $r2 = $this->db->query('select id from news where hash='.$r->getHash());

        return $r2 != false;
    }

    public function addNewsRecordIfNew(NewsRecord $r)
    {
        if ($this->isNewsRecordInDatabase($r)) return;
        $q = "insert into news (title, description, source_id, pubdate, hash)
                  values (:title, :description, :source, :pubDateForDB, :hash)";
        //echo "<p>query=$q</p>";
        $stmt =  $this->db->prepare($q);
        try {
            $res = $stmt->execute(array(
                ':title' => $r->getTitle(),
                ':description' => $r->getDescription(),
                ':source' => $r->getSource(),
                ':pubDateForDB' => $r->getPubdate(),
                ':hash' => $r->getHash()));
        }
        catch (PDOException $ex) {
            echo "!!! exception";
            echo $ex->getMessage();
        }
    }

    public function getNewsRecords($where, $limit, $offset)
    {
        $stmt = $this->db->prepare('select * from news '.$where.' limit :limit offset :offset');
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();
        $r = $stmt->fetchAll();

        $recordsArray=array();
        foreach ($r as $row) {
            $record = new NewsRecord();
            $record->setId($row['id']);
            $record->setTitle($row['title']);
            $record->setDescription($row['description']);
            $record->setSource($row['source_id']);
            $record->setPubdate($row['pubdate']);
            array_push($recordsArray, $record);
        }

        return $recordsArray;
    }

    public function getNumberOfNewsRecords ($where)
    {
        $r = $this->db->query('select id from news'.$where);
        return $r->rowCount();
    }
}
