<?php

class users_controller extends controller
{
  protected $model_name = 'user';

  protected function view()
  {
    $this->view_register['page_title'] = 'Users';

    if (isset($_GET['edit'])) $this->view_register['page_subtitle'] = 'Edit';
    elseif (isset($_GET['add'])) $this->view_register['page_subtitle'] = 'Add new';

    $this->add_list_item('', 'get_name', true);
    $this->add_list_item('', 'email');
    $this->add_list_item('Updated', 'format_updated_at', true);

    parent::view();
  }
}