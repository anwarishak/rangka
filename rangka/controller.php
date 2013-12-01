<?php

abstract class controller
{
  public $secondary_path;
  public $tertiary_path;
  public $quarternary_path;

  protected $model_name;
  protected $models;
  protected $model;

  protected $template;
  protected $list_template = 'default_list.php';
  protected $view_template = 'default_view.php';
  protected $edit_template = 'default_edit.php';

  public function __constuct() 
  {

  }

  public static function get_instance($name, $secondary_path='', $tertiary_path='', $quarternary_path='')
  {
    $name = str_replace('-', '_', $name).'_controller';

    if (class_exists($name))
    {
      $controller = new $name;
      $controller->secondary_path = $secondary_path;
      $controller->tertiary_path = $tertiary_path;
      $controller->quarternary_path = $quarternary_path;
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
    $this->template = $this->list_template;

    if ($this->model_name)
    {
      if (empty($this->secondary_path))
      {
        $this->models = call_user_func($this->model_name.'::get_many');
      }
      else
      {
        $this->model = call_user_func($this->model_name.'::get_by_id', $this->secondary_path);
        $this->template = $this->view_template;
      }
    }

    $this->postget();
  }

  protected function view()
  {
    $models = $this->models;
    $model = $this->model;

    if (file_exists('templates/'.$this->template)) include 'templates/'.$this->template;
    elseif (file_exists('rangka/templates/'.$this->template)) include 'rangka/templates/'.$this->template;
  }
}