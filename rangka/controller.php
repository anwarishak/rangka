<?php

abstract class controller
{
  protected $name;
  protected $path_parts = array();

  protected $response_format = 'html';

  protected $model_name;
  protected $models;
  protected $model;

  protected $template;
  protected $standard_template = 'default.php';
  protected $list_template = 'list.php';
  protected $view_template = 'view.php';
  protected $edit_template = 'edit.php';

  protected $form;
  protected $post_errors = array();

  protected $list_items = array();
  protected $edit_items = array();
  protected $view_register = array();

  public function __construct()
  {

  }

  public function json_response()
  {
    $this->response_format = 'json';
    $this->list_template = 'json_list.php';
    $this->view_template = 'json_view.php';
    $this->edit_template = 'json_edit.php';
  }

  public static function get_instance($name, $path_parts)
  {
    $controller_name = $name.'_controller';

    if (class_exists($controller_name))
    {
      $controller = new $controller_name;
      $controller->name = $name;
      $controller->path_parts = $path_parts;

      if (isset($_GET['json'])) $controller->json_response();
    }
    else
    {
      header('HTTP/1.0 404 Not Found');
      $controller = new page_not_found_controller;
      $controller->name = 'page_not_found';
    }

    return $controller;
  }

  public function process()
  {
    // $session = session::get_instance();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['_METHOD'])) $request_method = strtoupper(trim($_POST['_METHOD']));
    elseif ($_SERVER['REQUEST_METHOD'] == 'POST') $request_method = 'POST';
    elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') $request_method = 'PUT';
    elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') $request_method = 'DELETE';
    else $request_method = 'GET';

    $this->form = new form;

    switch ($request_method)
    {
      case 'POST': // Create
        $this->post();
        break;
      case 'PUT': // Update
        $this->put();
        break;
      case 'DELETE': // Delete
        $this->delete();
        break;
      default: // Read
        $this->get();
        break;
    }

    $this->view();
  }

  protected function preget() {}

  protected function postget() {}

  protected function get()
  {
    $this->preget();
    $this->template = $this->standard_template;

    if ($this->model_name)
    {
      if (isset($_GET['add']))
      {
        $this->model = new $this->model_name;
        $this->add_edit_items();
        $this->template = $this->edit_template;
      }
      elseif (empty($this->path_parts[0]))
      {
        $this->models = call_user_func($this->model_name.'::get_many');
        $this->add_list_items();
        $this->template = $this->list_template;
      }
      else
      {
        $this->model = call_user_func($this->model_name.'::get_by_id', $this->path_parts[0]);
        $this->add_edit_items();
        $this->template = $this->view_template;
        if (isset($_GET['edit'])) $this->template = $this->edit_template;
      }
    }

    $this->postget();
  }

  protected function prepost() {}

  protected function postpost() {}

  protected function post()
  {
    $this->prepost();

    $this->assign_form_inputs();
    $this->form->validate();

    $this->postpost();
  }

  protected function preput() {}

  protected function postput() {}

  protected function put()
  {
    $this->preput();



    $this->postput();
  }

  protected function predelete() {}

  protected function postdelete() {}

  protected function delete()
  {
    $this-> predelete();



    $this->postdelete();
  }

  protected function add_list_items() {}

  protected function add_list_item($title, $property_or_method_name='', $is_method=false)
  {
    $this->list_items[] = array(
      'title' => $title,
      'property_name' => ($is_method ? '' : $property_or_method_name),
      'method_name' => ($is_method ? $property_or_method_name : '')
    );
  }

  protected function add_edit_items() {}

  protected function add_edit_item($title, $property_name, $type='text', $model_property=null)
  {
    $this->edit_items[] = array(
      'title' => $title,
      'property_name' => $property_name,
      'type' => $type, // text, short_text, textarea, password, file, date, date_time, checkbox
      'model_property' => $model_property
    );
  }

  protected function view()
  {
    $models = $this->models;
    $model = $this->model;
    $controller_name = $this->name;
    $list_items = $this->list_items;
    $edit_items = $this->edit_items;
    $form = $this->form;

    foreach ($this->view_register as $key => $val)
    {
      $$key = $val;
    }

    if (file_exists('templates/'.$this->template)) include 'templates/'.$this->template;
    elseif (file_exists('rangka/templates/'.$this->template)) include 'rangka/templates/'.$this->template;
  }
}