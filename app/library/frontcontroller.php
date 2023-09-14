<?php

namespace SEVENAJJY\Library;

class FrontController
{

    const NOT_FOUND_ACTION = 'notFoundAction' ;
    const NOT_FOUND_CONTROLLER = 'SEVENAJJY\Controllers\NotFoundController' ;
    const CONTROLLER_DEFAULT_VALUE = "index";
    const ACTION_DEFAULT_VALUE = "default";

    /**
     * controller Name
     * @var string $_controller
     */
    private string $_controller = self::CONTROLLER_DEFAULT_VALUE;

    /**
     * Action Name
     * @var string $_action
     */
    private string $_action = self::ACTION_DEFAULT_VALUE;

    /**
     * controller Name
     * @var array $_params
     */
    private array $_params = [];

    /**
     * template
     *
     * @var Template
     */
    private  $_template;
    /**
     * template
     *
     * @var Language
     */
    private  $_language;

    public function __construct(Template $template, Language $language)
    {
        $this->_parseURL();
        $this->_template = $template;
        $this->_language = $language;
    }

    private function _parseURL()
    {
        $url =  explode('/' , trim(parse_url($_SERVER['REQUEST_URI'] , PHP_URL_PATH) , '/') , 3);
        if(isset($url[0]) && $url[0] !== ""){
            $this->_controller = $url[0] ;
        }
        if(isset($url[1]) && $url[1] !== ""){
            $this->_action = $url[1] ;
        }
        if(isset($url[2]) && $url[2] !== ""){
            $this->_params = explode('/' , $url[2]);
        }
    } 

    public function dispatch()
    {
        $controllerClassName = 'SEVENAJJY\Controllers\\' . ucwords($this->_controller) . 'Controller';
        $actionName = $this->_action . 'Action';

        if (!class_exists($controllerClassName)) {
            $controllerClassName = self::NOT_FOUND_CONTROLLER ;
        }

        if (!method_exists(new $controllerClassName, $actionName)) {
            $this->_action = $actionName = self::NOT_FOUND_ACTION ;
        }

        $controller = new $controllerClassName();
        $controller->setController($this->_controller);
        $controller->setAction($this->_action);
        $controller->setParams($this->_params);
        $controller->setTemplate($this->_template);
        $controller->setLanguage($this->_language);
        $controller->$actionName();
    }
}