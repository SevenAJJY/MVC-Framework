<?php
namespace SEVENAJJY\Models ;
class ClientInvoiceDetailsModel extends AbstractModel
    {
        public $Id ;
        public $ProductId ;
        public $Quantity ;
        public $ProductPrice ; 
        public $InvoiceId ; 


        protected static $tableName = 'app_sales_invoices_details' ;
        protected static $tableSchema = array(
            'ProductId'        => self::DATA_TYPE_INT, 
            'Quantity'         => self::DATA_TYPE_INT,
            'ProductPrice'     => self::DATA_TYPE_DECIMAL,
            'InvoiceId'        => self::DATA_TYPE_INT,
        );
        protected static $primaryKey = 'Id' ;


        /**
         * @param ClientInvoiceModel $invoice
         * 
         * @return ArrayIterator|false
         */
        public static function getInvoiceById(ClientInvoiceModel $invoice){
            return self::get(
                "SELECT *,
                (SELECT Name FROM  ".ProductModel::getModelTableName()." WHERE ".ProductModel::getModelTableName().".ProductId = ".self::$tableName .".ProductId) Name, 
                (SELECT Unit FROM  ".ProductModel::getModelTableName()." WHERE ".ProductModel::getModelTableName().".ProductId = ".self::$tableName .".ProductId) Unit, 
                (SELECT PiecesInBox FROM  ".ProductModel::getModelTableName()." WHERE ".ProductModel::getModelTableName().".ProductId = ".self::$tableName .".ProductId) PiecesInBox
                FROM ".self::$tableName ." WHERE InvoiceID = ".$invoice->InvoiceId
            );
        }

        // public static function getQuantityStatus(){
        //     $status = self::get(
        //         'SELECT asid.*, apl.Quantity
        //         FROM ' . self::$tableName . ' asid 
        //         INNER JOIN app_products_list apl 
        //         ON apl.ProductId = asid.ProductId'
        //     );
        //     return $status ;
        // }
    }