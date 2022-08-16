<?php

namespace SEVENAJJY ;

use SEVENAJJY\LIBRARY\FrontController;

defined('DS') or define('DS' , DIRECTORY_SEPARATOR);

require_once '..' . DS . 'app' . DS . 'config' . DS . 'config.php' ;

require_once APP_PATH . DS . 'library' . DS .  'autoload.php' ;

session_start();
// $session = new SessionManager();
// $session->start();


$frontController = new FrontController();
$frontController->dispatch();