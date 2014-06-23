<?php
/**
 * Created by PhpStorm.
 * User: dmitrychabanenko
 * Date: 6/23/14
 * Time: 7:20 PM
 */

class NewsRecord {

    protected $title;

    protected $description;

    protected $source;

    protected $pubdate;

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPubdate()
    {
        return $this->pubdate;
    }

    /**
     * @param mixed $pubdate
     */
    public function setPubdate($pubdate)
    {
        $this->pubdate = $pubdate;
    }

    /**
     * @return mixed
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param mixed $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }


} 