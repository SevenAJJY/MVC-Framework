<?php

namespace SEVENAJJY ;

use SEVENAJJY\Library\Authentication;
use SEVENAJJY\Library\SessionManager;
use SEVENAJJY\Library\Language;
use SEVENAJJY\LIBRARY\Template\Template;
use SEVENAJJY\LIBRARY\FrontController;
use SEVENAJJY\Library\Messenger;
use SEVENAJJY\Library\Registry;

defined('DS') or define('DS' , DIRECTORY_SEPARATOR);

require_once '..' . DS . 'app' . DS . 'config' . DS . 'config.php' ;
require_once APP_PATH . DS . 'library' . DS .  'autoload.php' ;

$template_parts = require_once '..' . DS . 'app' . DS . 'config' . DS . 'templateconfig.php' ;

$session = new SessionManager();
$session->start();

if (!isset($session->lang)) {
    $session->lang = APP_DEFAULT_LANGUAGE;
}

$template = new Template($template_parts);

$language = new Language();

$messenger = Messenger::getInstance($session);

$authentication = Authentication::getInstance($session);

$registry = Registry::getInstance();
$registry->session   = $session;
$registry->language  = $language;
$registry->messenger = $messenger;


$frontController = new FrontController($template, $registry, $authentication);

$frontController->dispatch();


?>