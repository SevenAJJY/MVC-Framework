<?php
namespace SEVENAJJY\Models ;
class ClientModel extends AbstractModel
    {
        public $ClientId ;
        public $Name ;
        public $PhoneNumber ; 
        public $Email ; 
        public $Address ; 
        public $PartitaIVA ; 
        public $CodFISC ; 

        protected static $tableName = 'app_clients' ;
        protected static $tableSchema = array(
            'Name'        => self::DATA_TYPE_STR, 
            'PhoneNumber' => self::DATA_TYPE_STR,
            'Email'       => self::DATA_TYPE_STR,
            'Address'     => self::DATA_TYPE_STR,
            'PartitaIVA'  => self::DATA_TYPE_STR,
            'CodFISC'     => self::DATA_TYPE_STR
        );
        protected static $primaryKey = 'ClientId' ;

        
    }