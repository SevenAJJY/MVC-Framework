<?php
namespace SEVENAJJY\Models ;

use SEVENAJJY\Models\AbstractModel;

class UserGroupsModel extends AbstractModel
    {
        public $GroupId ;
        public $GroupName ;

        protected static $tableName = 'app_users_groups' ;
        protected static $tableSchema = array(
            'GroupId'            => self::DATA_TYPE_INT, 
            'GroupName'          => self::DATA_TYPE_STR, 
        );
        protected static $primaryKey = 'GroupId' ;
    }