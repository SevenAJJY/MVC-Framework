<?php

namespace SEVENAJJY\Controllers;

use SEVENAJJY\Library\FrontController;

/**
 * Abstract Controller
 * @author yassine ELHAJJY
 *
 */


class AbstractController
{

    /**
     * Controller Name
     *
     * @var string
     */
    protected $_controller;

    /**
     * Acion Name
     *
     * @var string
     */
    protected $_action;

    /**
     * URL extracted parameters
     * which could be used for
     * any action
     *
     * @var array
     */
    protected $_params;

    public function notFoundAction()
    {
        $this->_renderView();
    }

    /**
     * Controller name setter
     *
     * @param string $controller            
     */
    public function setController($controllerName)
    {
        $this->_controller = $controllerName;
    }

    /**
     * Acion Name setter
     *
     * @param string $action            
     */
    public function setAction($actionName)
    {
        $this->_action = $actionName;
    }

    /**
     * URL extracted parameters
     * which could be used for
     * any action
     *
     * @var array
     */
    public function setParams($params)
    {
        $this->_params = $params;
    }

    protected function _renderView()
    {   
        if ($this->_action === FrontController::NOT_FOUND_ACTION) {
            require_once VIEWS_PATH . 'notfound' . DS . 'notfound.view.php' ;
        }
        else{
            $view = VIEWS_PATH . $this->_controller . DS . $this->_action . '.view.php';
            if (file_exists($view )) {
                require_once $view ;
            }
            else{
                require_once VIEWS_PATH . 'notfound' . DS . 'noview.view.php' ;
            }
        }
    }
}