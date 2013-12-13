<?php

abstract class controller
{
  protected $secondary_path;
  protected $tertiary_path;
  protected $quarternary_path;

  protected $response_format = 'html';

  protected $model_name;
  protected $models;
  protected $model;

  protected $template;
  protected $standard_template = 'default.php';
  protected $list_template = 'list.php';
  protected $view_template = 'view.php';
  protected $edit_template = 'edit.php';

  protected $post_errors = array();

  public function __constuct() 
  {

  }

  public function json_response()
  {
    $this->response_format = 'json';
    $this->list_template = 'json_list.php';
    $this->view_template = 'json_view.php';
    $this->edit_template = 'json_edit.php';
  }

  public static function get_instance($name, $secondary_path='', $tertiary_path='', $quarternary_path='')
  {
    $controller_name = str_replace('-', '_', $name).'_controller';

    if (class_exists($controller_name))
    {
      $controller = new $controller_name;
      $controller->secondary_path = $secondary_path;
      $controller->tertiary_path = $tertiary_path;
      $controller->quarternary_path = $quarternary_path;
      
      if (isset($_GET['json'])) $controller->json_response();
    }
    else
    {
      $controller = new page_not_found_controller;
    }

    return $controller;
  }

  public function process()
  {
    // $session = session::get_instance();

    switch ($_SERVER['REQUEST_METHOD'])
    {
      case 'POST':
        $this->post();
        break;
      case 'PUT':
        $this->put();
        break;
      case 'DELETE':
        $this->delete();
        break;
      default:
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
      if (empty($this->secondary_path))
      {
        $this->models = call_user_func($this->model_name.'::get_many');
        $this->template = $this->list_template;
      }
      else
      {
        $this->model = call_user_func($this->model_name.'::get_by_id', $this->secondary_path);
        $this->template = $this->view_template;
      }
    }

    $this->postget();
  }

  protected function prepost() {}

  protected function postpost() {}

  protected function post()
  {
    $this->prepost();



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

  protected function view()
  {
    $models = $this->models;
    $model = $this->model;

    if (file_exists('templates/'.$this->template)) include 'templates/'.$this->template;
    elseif (file_exists('rangka/templates/'.$this->template)) include 'rangka/templates/'.$this->template;
  }
}