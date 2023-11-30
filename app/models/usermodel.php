<?php

namespace SEVENAJJY\Models;

use ArrayIterator;
use SEVENAJJY\Library\SessionManager;
use SEVENAJJY\Models\AbstractModel;

class UserModel extends AbstractModel
{
    /**
     * table columns
     */
    public $UserId ;

    public $Username ;

    public $Password ; 

    public $Email ; 

    public $PhoneNumber ; 

    public $SubscriptionDate ;

    public $LastLogin ;

    public $GroupId ;

    public $Status ;

    /**
     * @var UserProfileModel
     */
    public $profile ;
    /**
     * @var array
     */
    public $privileges ;

    /**
     * @var string $tableName
     */
    protected static $tableName = 'app_users' ;

    /**
     * @var string $primaryKey
     */
    protected static $primaryKey = 'UserId' ;

        /**
     * Names and types of table columns in the database
     * 
     * @var array $tableSchema
     */
    protected static $tableSchema = array(
        'UserId'            => self::DATA_TYPE_INT, 
        'Username'          => self::DATA_TYPE_STR, 
        'Password'          => self::DATA_TYPE_STR,
        'Email'             => self::DATA_TYPE_STR,
        'PhoneNumber'       => self::DATA_TYPE_STR,
        'SubscriptionDate'  => self::DATA_TYPE_STR,
        'LastLogin'         => self::DATA_TYPE_STR,
        'GroupId'           => self::DATA_TYPE_INT,
        'Status'            => self::DATA_TYPE_INT
    );

    /** 
     * Encrypt user password 
     * 
     * @param string $password
     * @return void
     */
    public function cryptPassword($password)
    {
        $this->Password = crypt($password,APP_SALT);
    }

    /**
     * Fetch the list of all users except the current user, through the information they recorded in the session when logging in
     *
     * @param UserModel $user
     * @return \ArrayIterator|false
     */
    public static function getUsers($user): ArrayIterator|false
    {
        return self::get(
            'SELECT au.*,aug.GroupName GroupName FROM ' . self::$tableName . ' as au INNER JOIN app_users_groups as aug ON aug.GroupId = au.GroupId WHERE au.UserId != ' .$user->UserId
        );
    }

    public static function userExists($username)
    {
        return self::getBy(['Username' => $username]);
    }

    public static function emailExists($email)
    {
        return self::getBy(['Email' => $email]);
    }

 /**
  * @param string $username
  * @param string $password
  * @param SessionManager $session
  * 
  * @return false|int
  */
    public static function authenticate(string $username, string $password, SessionManager $session){
        $password = crypt($password,APP_SALT);
        $sql = 'SELECT *,(SELECT GroupName FROM app_users_groups WHERE app_users_groups.GroupId = '.self::$tableName.'.GroupId) as GroupName FROM '. self::$tableName .' WHERE Username = "' . $username . '" AND Password = "' . $password . '"' ;
        $foundUser = self::getOne($sql);
        if (false !==  $foundUser) {
            /**
             * 2 -> If the user is banned by the administration (disabled)
             */
            if ($foundUser->Status == 2) {
                return 2 ;
            }
            $foundUser->LastLogin = date('Y-m-d H:i:s');
            $foundUser->save();
            $foundUser->profile = UserProfileModel::getByKey($foundUser->UserId);
            $foundUser->privileges = UserGroupsPrivilegeModel::getPrivilegesForGroup($foundUser->GroupId) ;
            $session->u = $foundUser;
            /**
             * 1 -> If the user is already registered, we will record his last login,
             * and then store his information in the Session
             */
            return 1 ;
        }
        /**
         *  false -> if it does not exist at all
         */
        return false ;
    }

}