<?php

class DB extends PDO
{

    private $tablename = 'video';

    function __construct()
    {
        parent::__construct("mysql:host=" . _host_ . ";dbname=" . _dbname_ . ";", _user_, _pass_);
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_CLASS);

        $this->query("SET CHARACTER SET UTF8");
    }

    public function create($video)
    {

        $str = 'VideoTitle = "' . $video->VideoTitle . '",';
        $str .= 'VideoSize = ' . $video->VideoSize . ',';
        $str .= 'VideoLength = ' . $video->VideoLength . ',';
        $str .= 'VideoLink = "' . $video->VideoLink . '"';

        try {
            $query = $this->prepare("INSERT INTO {$this->tablename} SET {$str}");
            $query->execute();
        } catch (PDOException $e) {
            dd($e->getMessage());
        }
        if ($query->rowCount()) {
            return $this->lastInsertId();
        } else {
            return false;
        }
    }

    function select()
    {
        $query = $this->query("SELECT * FROM $this->tablename");
        $items = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {
            return $items;
        } else {
            return false;
        }
    }
}
