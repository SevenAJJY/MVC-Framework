<?php

namespace SEVENAJJY\Controllers;

use SEVENAJJY\Library\FrontController;
use SEVENAJJY\Library\InputFilter;
use SEVENAJJY\Library\Redirection;
use SEVENAJJY\Library\Template\Template;
use SEVENAJJY\Library\Language;
use SEVENAJJY\Library\Registry;
use SEVENAJJY\Library\Validate;

/**
 * Abstract Controller
 * @package SEVENAJJY\Controllers
 * 
 * @author yassine ELHAJJY
 *
 */


class AbstractController
{

    use InputFilter;
    use Redirection;
    use Validate;

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

        /**
     * Data array used to keep track of
     * all data passed to the view
     * @var array
     */
    protected $_data = [];


    /**
     * Controller name setter
     *
     * @param string $controller            
     */

    /**
     * template
     *
     * @var Template
     */
    protected Template $_template;

    /**
     * @var Registry
     */
    protected Registry $_registry;

    public function __get($key){
        return $this->_registry->$key;
    }

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
     * Parameters array setter
     *
     * @param array $params            
     */
    public function setParams($params)
    {
        $this->_params = $params;
    }

    
    public function setTemplate(Template $template){
        $this->_template = $template;
    }
    
    public function setRegistry(Registry $registry){
        $this->_registry = $registry;
    }

    public function notFoundAction()
    {
        $this->_renderView();
    }

    /**
     * Used to get a stored parameter back in a given type
     *
     * @param int $key            
     * @param string $type            
     * @example _getParam(1, 'int');
     * @return mixed
     */
    protected function _getParams(int $key, string $type):mixed
    {
        if (array_key_exists($key, $this->_params)) {
            $type = strtolower($type);
            $value = '';
            switch($type){
                case 'int':
                    $value = $this->filterInt($this->_params[$key]);
                    break;
                case 'string':
                    $value = $this->filterString($this->_params[$key]);
                    break;
                case 'float':
                    $value = $this->filterFloat($this->_params[$key]);
                    break;
            }
            return $value ;
        }
        else{
            return false;
        }
    }

    protected function _renderView()
    {   
        $view = VIEWS_PATH . $this->_controller . DS . $this->_action . '.view.php';
        if ($this->_action == FrontController::NOT_FOUND_ACTION || !file_exists($view)) {
            $view = VIEWS_PATH . 'notfound' . DS . 'notfound.view.php' ;
        }
        $this->_data = array_merge($this->_data, $this->language->getDictionary());
        $this->_template->setRegistry($this->_registry);
        $this->_template->setActionViewFile($view);
        $this->_template->setAppData($this->_data);
        $this->_template->renderApp();
    }
}