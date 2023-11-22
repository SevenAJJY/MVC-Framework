<?php

namespace SEVENAJJY\Library;

/**
 * When you create a lot of objects in Index.php.
 * Class Registry() will help us make them available in Controllers And views
 */
class Registry{
    /**
     * @var self
     */
    private static $_instance;

    /**
     * Private __construct() to prevent making an instance
     */
    private function __construct(){}

    /**
     * Private __clone() To ensure and make sure not to clone O object outside the class
     * @return void
     */
    private function __clone(){}

    /**
     * @return self
     */
    public static function getInstance(){
        if (self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * To get to things inside registry we use __get() and __set() (dynamically)
     */
    public function __set($key, $object){
        $this->$key =  $object;
    }

    public function __get($key){
        return $this->$key;
    }
}