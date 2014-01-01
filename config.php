<?php

switch ($_SERVER['HTTP_HOST'])
{
  case 'localhost':
  case 'localhost:8080':
    // Development settins
    define('DEBUG', true);
    break;

  case 'staging.rangka.com':
    // Staging settings
    define('DEBUG', true);
    break;

  default:
    // Production settings
    break;
}

if (!defined('DEBUG'))       define('DEBUG', 'false');

if (!defined('DB_TYPE'))     define('DB_TYPE', 'mysql');
if (!defined('DB_HOST'))     define('DB_HOST', 'localhost');
if (!defined('DB_USERNAME')) define('DB_USERNAME', 'root');
if (!defined('DB_PASSWORD')) define('DB_PASSWORD', 'password');
if (!defined('DB_NAME'))     define('DB_NAME', 'rangka');