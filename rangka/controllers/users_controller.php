<?php

class users_controller extends controller
{
  protected $model_name = 'user';

  protected function view()
  {
    $this->view_register['page_title'] = 'Users';
    parent::view();
  }
}