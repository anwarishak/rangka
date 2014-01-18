<?php

$path = isset($_SERVER['REDIRECT_URL']) ? trim($_SERVER['REDIRECT_URL'], '/ ') : '';
$path_parts = explode('/', $path);

if ($path_parts[0] == 'api' && isset($path_parts[1]) && $path_parts[1] == 'v1' && isset($path_parts[2]))
{
  $controller_name = 'api_v1_'.$path_parts[2];
  for ($i=0; $i<2; $i++) array_shift($path_parts);
}
else
{
  $controller_name = empty($path_parts[0]) ? 'home' : $path_parts[0];
  array_shift($path_parts);
}

$controller_name = preg_replace('/[^a-zA-Z0-9]+/', '_', $controller_name);

$controller = controller::get_instance($controller_name, $path_parts);
$controller->process();



/*

$main_path = empty($path_parts[0]) ? 'home' : $path_parts[0];
$secondary_path = empty($path_parts[1]) ? '' : $path_parts[1];
$tertiary_path = empty($path_parts[2]) ? '' : $path_parts[2];
$quarternary_path = empty($path_parts[3]) ? '' : $path_parts[3];

// DO ALL CUSTOM ROUTING / URL MANIPULATION HERE
// $main_path SHOULD ALWAYS BE THE CONTROLLER NAME

$controller = controller::get_instance($main_path, $secondary_path, $tertiary_path, $quarternary_path);
$controller->process();

*/







// Utility functions

function __autoload($class_name)
{
  $file = $class_name.'.php';

  if (file_exists('rangka/'.$file)) include 'rangka/'.$file;
  elseif (file_exists('controllers/'.$file)) include 'controllers/'.$file;
  elseif (file_exists('models/'.$file)) include 'models/'.$file;
  elseif (file_exists('rangka/controllers/'.$file)) include 'rangka/controllers/'.$file;
  elseif (file_exists('rangka/models/'.$file)) include 'rangka/models/'.$file;
}

function __($str, $is_echo=true)
{
  $str = htmlentities($str);

  if ($is_echo) echo $str;
  else return $str;
}