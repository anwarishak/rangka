<?php

class database
{
  protected static $instance = null;
  protected $handle = null;
  protected $error = null;

  protected function __construct()
  {
    $this->connect();
  }

  protected function __clone() {}

  public static function get_instance()
  {
    if (self::$instance == null)
    {
      self::$instance = new database;
    }

    return self::$instance;
  }

  protected function connect()
  {
    $this->handle = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USERNAME, DB_PASSWORD);
  }

  public function query($sql, $params=array())
  {
    $results = null;
    $sth = $this->handle->prepare($sql);
    //file_put_contents('sql.txt', $sql."\n\n", FILE_APPEND);
    //echo $sql.'<br>';

    if ($sth->execute($params))
    {
      $results = $sth->fetchAll();
    }
    else
    {
      //echo $sql;
      $error_info = $sth->errorInfo();
      $this->error = $error_info[2];
      if (ENV != 'LIVE') throw new Exception($this->error);
    }

    return $results;
  }

  public function get_last_insert_id()
  {
    $result = null;
    $sql = "SELECT LAST_INSERT_ID();";

    if ($results = $this->query($sql))
    {
      $result = $results[0][0];
    }

    return $result;
  }

  public function get_error()
  {
    return $this->error;
  }

  public function get_value($sql, $params=array())
  {
    $result = false;

    if ($rows = $this->query($sql, $params))
    {
      $result = $rows[0][0];
    }

    return $result;
  }
}