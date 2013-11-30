<?php

define('DB_TYPE', 'mysql');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'password');
define('DB_NAME', 'rangka');

switch ($_SERVER['HTTP_HOST'])
{
  case 'rangka.local':
  case 'rangka.dev':
    // Development settins
    define('DEBUG', true);
    define('DB_HOST', 'localhost');
    break;

  case 'rangka.demo.com':
    // Staging settings
    define('DEBUG', true);  
    define('DB_HOST', 'localhost');
    break;

  default:
    // Porduction settings
    define('DEBUG', true);  
    define('DB_HOST', 'localhost');
    break;
}