<?php

$path = isset($_SERVER['REDIRECT_URL']) ? trim($_SERVER['REDIRECT_URL'], '/ ') : '';
$path_parts = explode('/', $path);

$main_path = empty($path_parts[0]) ? 'home' : $path_parts[0];
$secondary_path = empty($path_parts[1]) ? '' : $path_parts[1];
$tertiary_path = empty($path_parts[2]) ? '' : $path_parts[2];
$quarternary_path = empty($path_parts[3]) ? '' : $path_parts[3];

$controller = controller::get_instance($main_path);










// Utility functions

function __autoload($class_name)
{
  $rangka_file = 'rangka/'.$class_name.'.php';
  include $rangka_file;
}