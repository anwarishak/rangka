<?php

abstract class controller
{
  public $secondary_path;
  public $tertiary_path;
  public $quarternary_path;

  protected $model_name;
  protected $models;
  protected $model;

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
  }

  protected function get()
  {
    if (empty($this->secondary_path))
    {
      $this->models = call_user_func($this->model_name.'::get_many');
    }
  }
}