<?php

namespace SEVENAJJY\Library;

/**
 * Authentication We will use it to find out if the user is Log in or not
 */
class Authentication{

    /**
     * @var self
     */
    private static $_instance;
    /**
     * @var SessionManager
     */
    private $_session;

    /**
     * Excluded Routes to not be sure of them with the Privileges  الاستثناءات
     *
     * @var array
     */
    private $_excludedRoutes = 
    [
        '/index/default' ,
        '/auth/logout' ,
        '/users/profile' ,
        '/users/checkuserexistsajax' ,
        '/users/checkemailexistsajax' ,
        '/users/settings' ,
        '/language/default' ,
        '/accessdenied/default' ,
        '/notfound/notfound',
        '/users/profile',
        '/users/editprofile',
        '/users/changepassword',
        '/users/view',
        '/test/default',
    ];

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

    public function hasAccess($controller, $action)
    {
        $url = strtolower('/'.$controller.'/'.$action);
        if (in_array($url,$this->_excludedRoutes) || in_array($url, $this->_session->u->privileges)) {
            return true ;
        }
    }
}