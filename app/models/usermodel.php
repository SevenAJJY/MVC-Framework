<?php

namespace SEVENAJJY\Models;

use ArrayIterator;
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

    public static function getAll(): ArrayIterator|false {
        return self::get("
            SELECT au.*,aug.GroupName FROM " . self::$tableName ." as au INNER JOIN app_users_groups as aug ON au.GroupId = aug.GroupId
        ");
    }

    public static function userExists($username)
    {
        return self::getBy(['Username' => $username]);
    }

    public static function emailExists($email)
    {
        return self::getBy(['Email' => $email]);
    }

}