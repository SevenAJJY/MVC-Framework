<?php 

namespace SEVENAJJY\Library;

/**
 * Session manager
 * @author  yassine El hajjy (SevenAJJY) <yassine.elhajjy@gmail.com>
 * 
 * @see https://github.com/SevenAJJY
 */


class SessionManager extends \SessionHandler
{

    const SESSION_NAME = "SEVENAJJYSESS";
    const SESSION_LIFE_TIME = 0;
    const TIME_TO_LIVE = 10;
    const SESSION_CIPHER_ALGO = 'AES-128-ECB';
    CONST SESSION_CIPHER_KEY = 'S3V3NAJJYSN@2022';

    /**
     *  Session Name
     *
     * @var string
     */
    private string $_sessName = self::SESSION_NAME ;

    /**
     *  Specifies the lifetime of the cookie in seconds which is sent to the browser.
     *  The value 0 means "until the browser is closed.
     *
     * @var int
     */
    private int $_sessMaxLifeTime = self::SESSION_LIFE_TIME;
    
    /**
     *  Specifies whether cookies should only be sent over secure connections.
     *
     * @var bool
     */
    private bool $_sessSSL = false;
    
    /**
     *  Specifies how to access the cookies
     *  The value 'True' means that the cookie won't be accessible by scripting languages, such as JavaScript.
     *  This setting can effectively help to reduce identity theft through XSS attacks
     *
     * @var bool
     */
    private bool $_sessHTTPOnly = true;

    /**
     *  Specifies path to set in the session cookie.
     *
     * @var string
     */
    private string $_sessPath = "/";

    /**
     * Specifies the domain to set in the session cookie.
     *
     * @var string
     */
    private string $_sessDomain = ".sevenajjy.com" ;

    /**
     * This is the path where the files are created.
     *
     * @var string
     */
    private string $_sessSavePath = SESSION_SAVE_PATH;

    /**
     * The algorithm used to encrypt session data.
     *
     * @var string
     */
    private string $_sessCipherAlgo = self::SESSION_CIPHER_ALGO;

    /**
     * The The key used to encrypt and re-decrypt session data .
     *
     * @var string
     */
    private string $_sessCipherKey = self::SESSION_CIPHER_KEY;

    /**
     *  Time to live .
     *  The value 0 means "until the browser is closed.
     *
     * @var int
     */
    private int $_ttl = self::TIME_TO_LIVE;

    public function __construct()
    {
        /**
         * Set a set of settings in a file php.ini
         */
        ini_set('session.use_cookies', 1);
        ini_set('session.use_only_cookies', 1);
        ini_set('session.use_trans_sid', 0);
        ini_set('session.save_handler', "files");

        session_name($this->_sessName);
        session_save_path($this->_sessSavePath);

        session_set_cookie_params(
            $this->_sessMaxLifeTime, 
            $this->_sessPath, 
            $this->_sessDomain, 
            $this->_sessSSL,
            $this->_sessHTTPOnly
        );
    }



    public function __get($key)
    {
        if (isset($_SESSION[$key])) {
            $data = $_SESSION[$key] ;
            if ($data === false) {
                return $_SESSION[$key];
            }
            else {
                return $data; 
            }
        } else {
            trigger_error("No Session Key ". $key . " exists", E_USER_ERROR);
        }
    }


    /**
     * @param mixed $key
     * @param mixed $value
     * @return void
     */
    public function __set(mixed $key, mixed $value):void
    {
        if (is_object($value)) {
            $_SESSION[$key] = $value;
        }
        else{
            $_SESSION[$key] = $value ;
        }
    }

    /**
     * @param mixed $key
     * @return bool
     */
    public function __isset(mixed $key):bool
    {
        return isset($_SESSION[$key]) ? true : false ;
    }

    public function __unset($key)
    {
        unset($_SESSION[$key]);
    }

    /**
     * Read session data
     * 
     * @param string $sessId — The session id to read data for.
     * @return string|false
     */
    public function read(string $sessId):string|false
    {
        return openssl_decrypt(parent::read($sessId), $this->_sessCipherAlgo, $this->_sessCipherKey);
    }

    /**
     * Write session data
     * 
     * @param string $sessId — The session id.
     * @param string $data 
     * The encoded session data. This data is the result of the PHP internally encoding the $_SESSION superglobal to a serialized string and passing it as this parameter. Please note sessions use an alternative serialization method.
     * 
     * @return bool
     */
    public function write(string $sessId, string $data):bool
    {
        return parent::write($sessId, openssl_encrypt($data, $this->_sessCipherAlgo, $this->_sessCipherKey));
    }

    /**
     * Session start.
     * 
     * @return void
     */
    public function start():void
    {
        if ('' === session_id()) {
            if (session_start()) {
                $this->_setSessionStartTime();
                $this->_checkSessionValidity();
            }
        }
    }

    /**
     * Store the start time of the session in order to compare it with the time we set for the reset.
     * 
     * @return bool
     */
    private function _setSessionStartTime():bool
    {
        if (!isset($this->sessionStartTime)) {
            $this->sessionStartTime = time();
        }
        return true ;
    }

    /**
     * Compare the session start time with the session time to live,
     *  that we initially set in  order to reset the session ID and user fingerprint.
     * 
     * @return bool
     */
    private function _checkSessionValidity():bool
    {
        if ((time() - $this->sessionStartTime) > ($this->_ttl * 60)) {
            $this->_renewSession();
            $this->_generateFingerPrint();
        }
        return true ;
    }

    /**
     * Reset session start time with session ID change.
     * 
     * @return bool
     */
    private function _renewSession():bool
    {
        $this->sessionStartTime = time();
        return session_regenerate_id(true);
    }

    /**
     * Destroy the session and delete the cookie.
     * 
     * @return void
     */
    public function kill():void
    {
        session_unset();
        setcookie(
                $this->_sessName, "",time() - 1000,
                $this->_sessPath, $this->_sessDomain,
                $this->_sessSSL,$this->_sessHTTPOnly);
        session_destroy();
    }

    /**
     * Storing and encrypting the contents of the user agent in the session.
     * 
     * @return void
     */
    private function _generateFingerPrint():void
    {
        $userAgentId = $_SERVER["HTTP_USER_AGENT"];
        $this->cipherKey = openssl_random_pseudo_bytes(16);
        $sessionId = session_id();
        $this->fingerPrint = sha1($userAgentId . $this->cipherKey . $sessionId);
    }

    /**
     * Check if the contents of the user agent data match in each request.
     * 
     * @return bool
     */
    public function isValidFingerPrint():bool
    {
        if (!isset($this->fingerPrint)) {
            $this->_generateFingerPrint();
        }
        $fingerPrint = sha1($_SERVER['HTTP_USER_AGENT'] . $this->cipherKey . session_id());
        if ($fingerPrint === $this->fingerPrint) {
            return true ;
        }
        return false ;
    }
}