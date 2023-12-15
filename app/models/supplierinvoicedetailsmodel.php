<?php
namespace SEVENAJJY\Models ;
class SupplierInvoiceDetailsModel extends AbstractModel
    {
        public $Id ;
        public $ProductId ;
        public $Quantity ;
        public $ProductPrice ; 
        public $InvoiceID ; 


        protected static $tableName = 'app_purchases_invoices_detailes' ;
        protected static $tableSchema = array(
            'ProductId'        => self::DATA_TYPE_INT, 
            'Quantity'         => self::DATA_TYPE_INT,
            'ProductPrice'     => self::DATA_TYPE_DECIMAL,
            'InvoiceID'        => self::DATA_TYPE_INT,
        );
        protected static $primaryKey = 'Id' ;

        /**
         * @param SupplierInvoiceModel $invoice
         * 
         * @return ArrayIterator|false
         */
        public static function getInvoiceById($invoice){
            return self::get(
                "SELECT *,
                (SELECT Name FROM  ".ProductModel::getModelTableName()." WHERE ".ProductModel::getModelTableName().".ProductId = ".self::$tableName .".ProductId) Name, 
                (SELECT Unit FROM  ".ProductModel::getModelTableName()." WHERE ".ProductModel::getModelTableName().".ProductId = ".self::$tableName .".ProductId) Unit, 
                (SELECT PiecesInBox FROM  ".ProductModel::getModelTableName()." WHERE ".ProductModel::getModelTableName().".ProductId = ".self::$tableName .".ProductId) PiecesInBox
                FROM ".self::$tableName ." WHERE InvoiceID = ".$invoice->InvoiceId
            );
        }
    }