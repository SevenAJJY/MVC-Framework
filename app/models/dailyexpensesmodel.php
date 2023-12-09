<?php
namespace SEVENAJJY\Models ;
class DailyExpensesModel extends AbstractModel
    {
        public $DExpenceId ;
        public $ExpenseId ;
        public $Payment ; 
        public $Created ; 
        public $UserId ; 
        public $Description ; 

        protected static $tableName = 'app_expences_daily_list' ;

        protected static $tableSchema = array(
            'ExpenseId'     => self::DATA_TYPE_INT,
            'Payment'       => self::DATA_TYPE_DECIMAL,
            'Created'       => self::DATA_TYPE_STR,
            'UserId'        => self::DATA_TYPE_INT,
            'Description'   => self::DATA_TYPE_STR,
        );
        
        protected static $primaryKey = 'DExpenceId' ;

        public static function getAll(): \ArrayIterator|false
        {
            return self::get('
                                SELECT aedl.*,aec.ExpenseName AS Name FROM '. self::$tableName . ' AS aedl 
                                LEFT JOIN '.ExpenseCategoryModel::getModelTableName().' aec 
                                ON aec.ExpenseId = aedl.ExpenseId');
        }

        public static function getLatest(): \ArrayIterator|false
        {
            return self::get('
                SELECT aedl.*,aec.ExpenseName AS Name FROM '. self::$tableName . ' AS aedl 
                LEFT JOIN '.ExpenseCategoryModel::getModelTableName().' aec 
                ON aec.ExpenseId = aedl.ExpenseId  ORDER BY '.self::$primaryKey.' DESC LIMIT 5');
        }
    }