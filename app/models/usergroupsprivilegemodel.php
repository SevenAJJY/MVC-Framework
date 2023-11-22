<?php
namespace SEVENAJJY\Models ;

use SEVENAJJY\Models\AbstractModel;

class UserGroupsPrivilegeModel extends AbstractModel
    {
        public $Id ;
        public $GroupId ;
        public $PrivilegeId ;

        protected static $tableName = 'app_users_groups_privileges' ;
        protected static $tableSchema = array(
            'GroupId'            => self::DATA_TYPE_INT, 
            'PrivilegeId'        => self::DATA_TYPE_INT, 
        );
        protected static $primaryKey = 'Id' ;

        
        /**
         * @param UserGroupsModel $group
         * 
         * @return \ArrayIterator|bool
         */
        public static function getGroupPrivileges(UserGroupsModel $group)
        {
            $groupPrivileges = self::getBy(['GroupId' => $group->GroupId]);
            $extractPrivilegesIds = [] ;
            if ($groupPrivileges != false) {
                foreach ($groupPrivileges as $privilege) {
                    $extractPrivilegesIds[] =  $privilege->PrivilegeId;
                }
            }
            return $extractPrivilegesIds ;
        }



    }