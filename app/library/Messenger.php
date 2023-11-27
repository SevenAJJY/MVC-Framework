<?php

namespace SEVENAJJY\Library;

/**
 * Class Messenger To control the display of messages in all destinations
 */
class Messenger{

    const APP_MESSAGE_SUCCESS = 1;
    const APP_MESSAGE_ERROR   = 2;
    const APP_MESSAGE_WARNING = 3;
    const APP_MESSAGE_INFO    = 4;

    /**
     * @var self
     */
    private  static $_instance;

    /**
     * @var SessionManager
     */
    private SessionManager $_session;

    /**
     * @var array
     */
    private array $_messages = [];

    /**
     * @param SessionManager $session
     */
    private function __construct(SessionManager $session){
        $this->_session = $session;
    }

    private function __clone(){}

    /**
     * @param SessionManager $session
     * 
     * @return self
     */
    public static function getInstance(SessionManager $session){
        if(self::$_instance === null){
            self::$_instance = new self($session);
        }
        return self::$_instance;
    }

    /**
     * To add messages in the session
     * @param mixed $message
     * @param int $type
     * 
     * @return void
     */
    public function add($message, $type = self::APP_MESSAGE_SUCCESS){
        if(!$this->messagesExists()){
            $this->_session->messages = [];
        }
        $msgs = $this->_session->messages;
        $msgs[] = [$message, $type];
        $this->_session->messages = $msgs;
    }

    /**
     * @return bool
     */
    private function messagesExists(){
        return isset($this->_session->messages);
    }

    /**
     * @return array
     */
    public function getMessages(){
        $this->_messages = [];
        if($this->messagesExists()){
            $this->_messages = $this->_session->messages;
            unset($this->_session->messages);
            return $this->_messages;
        }
        return [];
    }
}