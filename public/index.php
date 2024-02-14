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

$session = new SessionManager();
$session->start();

$template_parts = require_once '..' . DS . 'app' . DS . 'config' . DS . 'templateconfig.php' ;

if (!isset($session->lang)) {
    $session->lang = APP_DEFAULT_LANGUAGE;
}

$template = new Template($template_parts);

$language = new Language();

$messenger = Messenger::getInstance($session);

$authentication = Authentication::getInstance($session);

/**
 * Which object we will make in index.php and we will need in Controller we will pass it in our Registry class
 */
$registry = Registry::getInstance();
$registry->session   = $session;
$registry->language  = $language;
$registry->messenger = $messenger;


$frontController = new FrontController($template, $registry, $authentication);

$frontController->dispatch();

// require 'vendor/autoload.php';
// // require_once 'dompdf/autoload.inc.php';
// // reference the Dompdf namespace
// use Dompdf\Dompdf;

// // instantiate and use the dompdf class
// $dompdf = new Dompdf();
// $dompdf->loadHtml('hello world');

// // (Optional) Setup the paper size and orientation
// // $dompdf->setPaper('A4', 'landscape');

// // Render the HTML as PDF
// $dompdf->render();

// // Output the generated PDF to Browser
// $dompdf->stream();



?>