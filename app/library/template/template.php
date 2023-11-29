<?php
namespace SEVENAJJY\Library\Template;

use SEVENAJJY\Library\Registry;

class Template{
    use TemplateHelper;
    private array $_templateParts;
    private string $_actionView;
    private array $_data;
    private Registry $_registry;

    public function __get($key){
        return $this->_registry->$key;
    }

    public function setRegistry(Registry $registry){
        $this->_registry = $registry;
    }

    public function __construct(array $parts){
        $this->_templateParts = $parts;
    }

    /**
     * authentication
     * 
     * @param mixed $template
     * 
     * @return void
     */
    //TODO::implement a better solution
    public function swapTemplate($template)
    {
        $this->_templateParts['template'] = $template ;
    }

    /**
     * The view that will appear to the user
     *
     * @param string $actionViewPath
     * @return void
     */
    public function setActionViewFile($actionViewPath){
        $this->_actionView = $actionViewPath;
    }

    public function setAppData($data){
        $this->_data = $data;
    }
    private function _renderTemplateHeaderStart()
    {
        extract($this->_data);
        require_once TEMPLATE_PATH . 'templateheaderstart.php';

    }

    private function _renderTemplateHeaderEnd()
    {
        extract($this->_data);
        require_once TEMPLATE_PATH . 'templateheaderend.php';

    }

    private function _renderTemplateFooter(){
        extract($this->_data);
        require_once TEMPLATE_PATH . 'templatefooter.php';

    }

    private function _renderTemplateBlocks(){
        if (!array_key_exists('template', $this->_templateParts)) {
            trigger_error('Sorry you have to define the template blocks', E_USER_WARNING);
        }else{
            $parts = $this->_templateParts['template'];
            if (!empty($parts)) {
                extract($this->_data);
                foreach ($parts as $partKey => $file) {
                    if ($partKey === ':VIEW') {
                        require_once $this->_actionView;
                    }
                    else{
                        require_once $file;
                    }
                }
            }
        }
    }

    private function _renderHeaderResources(){
        $output = "";
        if (!array_key_exists('headerResources', $this->_templateParts)) {
            trigger_error('Sorry you have to define the header resources', E_USER_WARNING);
        }else{
            $resources = $this->_templateParts['headerResources'];
            // Generate CSS links
            $css = $resources['css'];
            if (!empty($css)) {
                foreach ($css as $cssKey => $path) {
                    $output .= '<link rel="stylesheet" href="'.$path.'" />';
                }
            }
        }
        echo $output;
    }
    private function _renderFooterResources(){
        $output = "";
        if (!array_key_exists('footerResources', $this->_templateParts)) {
            trigger_error('Sorry you have to define the footer resources', E_USER_WARNING);
        }else{
            $resources = $this->_templateParts['footerResources'];
            // Generate JavaScript links
            $js = $resources['js'];
            if (!empty($js)) {
                foreach ($js as $jsKey => $path) {
                    $output .= '<script src="'.$path.'"></script>';
                }
            }
        }
        echo $output;
    }

    public function renderApp(){
        $this->_renderTemplateHeaderStart();
        $this->_renderHeaderResources();
        $this->_renderTemplateHeaderEnd();
        $this->_renderTemplateBlocks();
        $this->_renderFooterResources();
        $this->_renderTemplateFooter();
    }
}