<?php
namespace SEVENAJJY\Models ;
class ExpenseCategoryModel extends AbstractModel
    {
        public $ExpenseId ;
        public $ExpenseName ;
        public $FixedPayment ; 

        protected static $tableName = 'app_expenses_categories' ;

        protected static $tableSchema = array(
            'ExpenseName'    => self::DATA_TYPE_STR, 
            'FixedPayment'   => self::DATA_TYPE_DECIMAL,
        );
        
        protected static $primaryKey = 'ExpenseId' ;

        public function hasRelatedExpensesList()
        {
            return self::get('SELECT * FROM app_expenses_daily_list WHERE DExpenseId = ' . $this->ExpenseId);
        }
    }