<?php
namespace SEVENAJJY\Models ;
class SupplierInvoiceModel extends AbstractModel
    {
        public $InvoiceId ;
        public $SupplierId ;
        public $PaymentType ;
        public $PaymentStatus ; 
        public $Created ; 
        public $Discount ; 
        public $UserId ; 
        public $AddedToStore ; 

        protected static $tableName = 'app_purchases_invoices' ;
        protected static $tableSchema = array(
            'SupplierId'        => self::DATA_TYPE_INT, 
            'PaymentType'       => self::DATA_TYPE_INT,
            'PaymentStatus'     => self::DATA_TYPE_INT,
            'Created'           => self::DATA_TYPE_STR,
            'Discount'          => self::DATA_TYPE_INT,
            'UserId'            => self::DATA_TYPE_INT,
            'AddedToStore'      => self::DATA_TYPE_INT
        );
        protected static $primaryKey = 'InvoiceId' ;

        public static function getAll():\ArrayIterator|false
        {
            $invoices = self::get(
                'SELECT api.*,  
                (SELECT SUM(ProductPrice * Quantity) FROM app_purchases_invoices_detailes WHERE InvoiceID = api.InvoiceId) total,
                (SELECT COUNT(*) FROM app_purchases_invoices_detailes WHERE InvoiceID = api.InvoiceId) ptotal,
                (SELECT SUM(PaymentAmount) FROM app_purchases_invoices_receipts WHERE app_purchases_invoices_receipts.InvoiceId = api.InvoiceId) totalPaid,
                (SELECT Name FROM app_suppliers WHERE app_suppliers.SupplierId = api.SupplierId) supplier
                FROM ' . self::$tableName . ' api'
            );
            return $invoices;
        }

        public function getInvoiceTotal()
        {
            return (int) self::get('SELECT SUM(ProductPrice * Quantity) total FROM app_purcheses_invoices_details WHERE InvoiceID = ' . $this->InvoiceId)->current()->total;
        }

        public static function getLatest(): \ArrayIterator|false{
            $invoices = self::get(
                'SELECT api.*,  
                (SELECT SUM(ProductPrice * Quantity) FROM app_purcheses_invoices_details WHERE InvoiceID = api.InvoiceId) total,
                (SELECT COUNT(*) FROM app_purcheses_invoices_details WHERE InvoiceID = api.InvoiceId) ptotal,
                (SELECT SUM(PaymentAmount) FROM app_purchases_invoices_receipts WHERE app_purchases_invoices_receipts.InvoiceId = api.InvoiceId) totalPaid,
                (SELECT Name FROM app_suppliers WHERE app_suppliers.SupplierId = api.SupplierId) supplier
                FROM ' . self::$tableName . ' api ORDER BY '.self::$primaryKey.' DESC LIMIT 5'
            );
            return $invoices;
        }

    }