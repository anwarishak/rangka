<?php

class form
{
  public $errors = array();

  public function __construct()
  {

  }

  public function __get($name)
  {
    $result = '';
    if (isset($this->$name)) $result = $this->$name;
    return $result;
  }

  public function validate()
  {

  }
}