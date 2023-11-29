<?php
namespace SEVENAJJY\Library\Template;

trait TemplateHelper {
    public function matchURL($url){
        return parse_url($_SERVER['REQUEST_URI'] , PHP_URL_PATH) === $url;
    }

    /**
     * method to help me when I made a mistake in a field version 1
     * 
     * @param mixed $fielfName
     * @param object|null $object
     * 
     * @return mixed
     */
    public function showValueV1($fielfName , $object = null)
    {
        return isset($_POST[$fielfName]) ? $_POST[$fielfName] : (is_null($object) ? '' : $object->$fielfName) ; 
    }

    /**
     * method to help me when I made a mistake in a field version 2
     *
     * @param string $fieldName
     * @param object|null $object
     * @param boolean $defaultValue
     * @return mixed
     */
    public function showValueV2($fieldName, $object = null, $defaultValue = false): mixed
    {
        return isset($_POST[$fieldName]) ? $_POST[$fieldName] : ($object === null ? ($defaultValue === false ? '' : $defaultValue) : $object->$fieldName);
    }

    
    /**
     * method to help me when I made a mistake in a field
     * 
     * @param mixed $fielfName
     * @param mixed $value
     * @param object|null $object
     * 
     * @return mixed
     */
    public function selectedIf($fielfName , $value , $object = null)
    {
        return ((isset($_POST[$fielfName]) && $_POST[$fielfName] == $value) || (!is_null($object) && $object->$fielfName  == $value)) ? 'selected="selected"' : '' ; 
    }
}