<?php

namespace SEVENAJJY\Library;

/**
 * This class will be responsible for obtaining the file you need,
 *  and also fetching all the elements and placing them in the action.
 */
class Language{

    private $_dictionary = [];
    
    public function load($path){
        $defaultLanguage = APP_DEFAULT_LANGUAGE;
        if (isset($_SESSION['lang'])) {
            $defaultLanguage = $_SESSION['lang'] ;
            }
        list($controller, $action) = explode('.', $path);
        $langFileToLoad = LANGUAGE_PATH . $defaultLanguage . DS . $controller . DS . $action . '.lang.php' ;
        if (file_exists($langFileToLoad)) {
            require_once $langFileToLoad;
            if (is_array($_) && !empty($_)) {
                foreach ($_ as $key => $value) {
                    $this->_dictionary[$key] = $value;
                }
                return $this->_dictionary;
            }
        }
        else{
            trigger_error('Sorry the language file '. $path . ' dosn\'t exitst', E_USER_WARNING);
        }
    }

    public function getDictionary(){
        return $this->_dictionary;
    }

    public function get($key){
        if(array_key_exists($key, $this->_dictionary)){
            return $this->_dictionary[$key];
        }
    }

    public function feedKey($key, $data)
    {
        if (array_key_exists($key ,$this->getDictionary())) {
            array_unshift($data , $this->_dictionary[$key]);
            return call_user_func_array('sprintf',$data);
        }
    } 
}