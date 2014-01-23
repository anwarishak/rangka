<?php

class users_controller extends controller
{
  protected $model_name = 'user';

  protected function view()
  {
    $this->view_register['page_title'] = 'Users';

    $this->add_list_property('', 'get_name', true);
    $this->add_list_property('', 'email');
    $this->add_list_property('Created', 'format_created_at', true);
    $this->add_list_property('Updated', 'format_updated_at', true);

    parent::view();
  }
}