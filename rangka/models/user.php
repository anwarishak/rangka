<?php

class user extends model
{
  protected $table_name = 'users';

  protected function add_properties()
  {
    $this->add_property('first_name', 'VARCHAR', '64');
    $this->add_property('last_name', 'VARCHAR', '64');
    $this->add_property('email', 'VARCHAR', '64');
    $this->add_property('password_hash', 'VARCHAR', '64');
    $this->add_property('last_signed_in', 'DATETIME');
  }

  public function get_name()
  {
    return $this->first_name.' '.$this->last_name;
  }
}