<?php

abstract class controller
{
  protected $secondary_path;
  protected $tertiary_path;
  protected $quarternary_path;

  protected $response_type;

  protected $model_name;
  protected $models;
  protected $model;

  protected $template;
  protected $standard_template = 'default.php';
  protected $list_template = 'default_list.php';
  protected $view_template = 'default_view.php';
  protected $edit_template = 'default_edit.php';

  public function __constuct() 
  {

  }

  public static function get_instance($name, $secondary_path='', $tertiary_path='', $quarternary_path='')
  {
    $name_parts = explode('.', $name);
    $controller_name = str_replace('-', '_', $name_parts[0]).'_controller';
    $response_type = !empty($name_parts[1]) ? $name_parts[1] : '';

    if (class_exists($controller_name))
    {
      $controller = new $controller_name;
      $controller->secondary_path = $secondary_path;
      $controller->tertiary_path = $tertiary_path;
      $controller->quarternary_path = $quarternary_path;
      $controller->response_type = $response_type;
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

  protected function view()
  {
    $models = $this->models;
    $model = $this->model;

    if (file_exists('templates/'.$this->template)) include 'templates/'.$this->template;
    elseif (file_exists('rangka/templates/'.$this->template)) include 'rangka/templates/'.$this->template;
  }
}