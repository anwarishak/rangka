<?php

class users_controller extends controller
{
  protected $model_name = 'user';

  protected function view()
  {
    $this->view_register['page_title'] = 'Users';
    $this->add_list_property('', 'get_name', true);
    $this->add_list_property('', 'email');
    $this->add_list_property('Created', 'created_at');
    $this->add_list_property('Updated', 'updated_at');
    parent::view();
  }
}