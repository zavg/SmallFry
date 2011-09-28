<?php
//*DEBUG ERROR REPORTING
ini_set('display_errors', 1); 
ini_set('log_errors', 1); 
ini_set('error_log', dirname(__FILE__) . '/error_log.txt'); 
error_reporting(E_ALL);
//END DEBUG ERROR REPORTING*/

session_start();

include './config/autoloader.php';

//DEFAULT TEMPLATE
App::set('APP_NAME', 'OPS');
//END DEFAULT TEMPLAT
//
//DEFAULT TEMPLATE
App::set('DEFAULT_TEMPLATE', 'default');
//END DEFAULT TEMPLATE

//DEFAULT TITLE
App::set('DEFAULT_TITLE', 'Strike Technologies Ops');
//END DEFAULT TITLE

//LOGIN SEED
App::set('LOGIN_SEED', "op87t4ilbhf");
//END LOGIN SEED

App::set('DEFAULT_CONTROLLER', 'Engine');