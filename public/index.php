<?php

namespace SEVENAJJY ;

use SEVENAJJY\Library\Language;
use SEVENAJJY\LIBRARY\Template;
use SEVENAJJY\LIBRARY\FrontController;

defined('DS') or define('DS' , DIRECTORY_SEPARATOR);

require_once '..' . DS . 'app' . DS . 'config' . DS . 'config.php' ;
require_once APP_PATH . DS . 'library' . DS .  'autoload.php' ;
$template_parts = require_once '..' . DS . 'app' . DS . 'config' . DS . 'templateconfig.php' ;
session_start();
// $session = new SessionManager();
// $session->start();
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = APP_DEFAULT_LANGUAGE;
}
$template = new Template($template_parts);
$language = new Language();
$frontController = new FrontController($template, $language);

$frontController->dispatch();
?>