<?php
namespace SEVENAJJY\Models ;

use SEVENAJJY\Models\AbstractModel;

class PrivilegesModel extends AbstractModel
    {
        public $PrivilegeId ;
        public $Privilege ;
        public $PrivilegeTitle ;

        protected static $tableName = 'app_users_privileges' ;
        protected static $tableSchema = array(
            'PrivilegeId'     => self::DATA_TYPE_INT, 
            'Privilege'       => self::DATA_TYPE_STR, 
            'PrivilegeTitle'  => self::DATA_TYPE_STR, 
        );
        protected static $primaryKey = 'PrivilegeId' ;
    }