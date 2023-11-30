<?php

namespace SEVENAJJY\Library;

use SEVENAJJY\Library\Template\Template;
class FrontController
{
    use Redirection;

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
     * @var SEVENAJJY\Library\Template\Template
     */
    private Template $_template;

    /**
     * @var Registry
     */
    private Registry $_registry;
    /**
     * @var Authentication
     */
    private Authentication $_authentication;

    public function __construct(Template $template, Registry $registry, Authentication $authentication)
    {
        $this->_template = $template;
        $this->_registry = $registry;
        $this->_authentication = $authentication;
        $this->_parseURL();
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

        /**
         * check if user is authorized to access the application .
         * Here if you are not registered and try to log in to any Controllers, it will direct you to /auth/login to make the login .
         */
        if (!$this->_authentication->isAuthorized()) {
            if ($this->_controller != 'auth' && $this->_action != 'login') {
                $this->redirect('/auth/login');
            }
        }else {
            /**
            * Here if the user is registered and tries to return to a page /auth/login without logging out, we will direct him to the home page.
            * But if he clicks on a link that leads him to a page /auth/login we will direct him to the page from which he clicked on the link via $_SERVER['HTTP_REFERER']
            * Summary: Deny access to /auth/login if there $this->session->u exists.
            */
            if ($this->_controller == 'auth' && $this->_action == 'login') {
                isset($_SERVER['HTTP_REFERER']) ? $this->redirect($_SERVER['HTTP_REFERER']) : $this->redirect('/') ;
            }
            /**
             * check if the user has access to Specific URL
             */
            if ((bool) CHECK_FOR_PRIVILEGES === true) {
                if (!$this->_authentication->hasAccess($this->_controller, $this->_action)) {
                    $this->redirect('/accessdenied');
                }
            }
        }

        if (!class_exists($controllerClassName) || !method_exists($controllerClassName , $actionName)) {
            $controllerClassName = self::NOT_FOUND_CONTROLLER ;
            $this->_action = $actionName = self::NOT_FOUND_ACTION;
        }
        
        $controller = new $controllerClassName();
        $controller->setController($this->_controller);
        $controller->setAction($this->_action);
        $controller->setParams($this->_params);
        $controller->setTemplate($this->_template);
        $controller->setRegistry($this->_registry);
        $controller->$actionName();
    }
}