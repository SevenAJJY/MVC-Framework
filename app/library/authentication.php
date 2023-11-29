<?php

namespace SEVENAJJY\Library;

/**
 * Authentication We will use it to find out if the user is Log in or not
 */
class Authentication{

    private static $_instance;
    private $_session;

    /**
     * Private __construct() to prevent making an instance
     * @param SessionManager $session
     */
    private function __construct(SessionManager $session){
        $this->_session = $session;
    }

    /**
     * Private __clone() To ensure and make sure not to clone O object outside the class
     */
    private function __clone(){}

    /**
     * @param SessionManager $session
     * 
     * @return self
     */
    public static function getInstance(SessionManager $session){
        if (self::$_instance == null) {
            self::$_instance = new self($session);
        }
        return self::$_instance;
    }

    public function isAuthorized(){
        return isset($this->_session->u);
    }
}