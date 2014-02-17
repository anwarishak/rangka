<?php

class users_controller extends controller
{
  protected $model_name = 'user';
  protected $list_template = 'users_list.php';

  protected function add_list_items()
  {
    $this->add_list_item('', 'get_name', true);
    $this->add_list_item('', 'email');
    $this->add_list_item('Updated', 'format_updated_at', true);
  }

  protected function add_edit_items()
  {
    $this->add_edit_item('First name', 'first_name');
    $this->add_edit_item('Last name', 'last_name');
    $this->add_edit_item('Email', 'email');
    $this->add_edit_item('Password', 'password', 'password', false);
    $this->add_edit_item('Repeat your password', 'repeat_password', 'password', false);
  }

  protected function view()
  {
    $this->view_register['page_title'] = 'Users';

    if (isset($_GET['edit'])) $this->view_register['page_subtitle'] = 'Edit';
    elseif (isset($_GET['add'])) $this->view_register['page_subtitle'] = 'Add new';

    parent::view();
  }
}