<?php
namespace SEVENAJJY\Models ;

use ArrayIterator;

class ProductModel extends AbstractModel
{
    public $ProductId ;
    public $CategoryId ;
    public $Name ;
    public $Image ; 
    public $Quantity ; 
    public $BuyPrice ;
    public $SellPrice ; 
    public $Unit ; 
    public $BarCode ; 

    protected static $tableName = 'app_products_list' ;

    protected static $tableSchema = array(
        'CategoryId'    => self::DATA_TYPE_INT, 
        'Name'          => self::DATA_TYPE_STR, 
        'Image'         => self::DATA_TYPE_STR,
        'Quantity'      => self::DATA_TYPE_INT,
        'BuyPrice'      => self::DATA_TYPE_DECIMAL,
        'SellPrice'     => self::DATA_TYPE_DECIMAL,
        'Unit'          => self::DATA_TYPE_INT,
        'BarCode'       => self::DATA_TYPE_STR
    );

    protected static $primaryKey = 'ProductId' ;

    public static function getAll(): ArrayIterator|false
    {
        $sql = 'SELECT apl.*,apc.Name as categoryName FROM '.self::$tableName . ' as apl ';
        $sql .= 'INNER JOIN '.ProductCategoryModel::getModelTableName() . ' as apc ';
        $sql .= 'ON apc.CategoryId = apl.CategoryId ';
        return self::get($sql);
    }
}