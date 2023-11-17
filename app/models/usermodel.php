<?php

namespace SEVENAJJY\Models;

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




    public function calculateSalary()
    {
        return $this->salary - ($this->salary * $this->tax /100);
    }
}