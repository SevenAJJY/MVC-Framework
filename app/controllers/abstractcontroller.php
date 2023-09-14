<?php

namespace SEVENAJJY\Controllers;

use SEVENAJJY\Library\FrontController;
use SEVENAJJY\Library\InputFilter;
use SEVENAJJY\Library\Redirection;
use SEVENAJJY\Library\Template;
use SEVENAJJY\Library\Language;

/**
 * Abstract Controller
 * @author yassine ELHAJJY
 *
 */


class AbstractController
{

    use InputFilter;
    use Redirection;

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
     * template
     *
     * @var Language
     */
    protected Language $_language;

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
    
    public function setLanguage(Language $language){
        $this->_language = $language;
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
        if ($this->_action === FrontController::NOT_FOUND_ACTION) {
            require_once VIEWS_PATH . 'notfound' . DS . 'notfound.view.php' ;
        }
        else{
            $view = VIEWS_PATH . $this->_controller . DS . $this->_action . '.view.php';
            if (file_exists($view )) {
                $this->_data = array_merge($this->_data, $this->_language->getDictionary());
                $this->_template->setActionViewFile($view);
                $this->_template->setAppData($this->_data);
                $this->_template->renderApp();
            }
            else{
                require_once VIEWS_PATH . 'notfound' . DS . 'noview.view.php' ;
            }
        }
    }
}