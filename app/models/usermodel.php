<?php

namespace SEVENAJJY\Models;

use SEVENAJJY\Models\AbstractModel;

class UserModel extends AbstractModel
{

    /**
     * table columns
     */
    public $id;
    public $name;
    public $age;
    public $address;
    public $tax;
    public $salary;
    public $image;

    /**
     * @var string $tableName
     */
    protected static string $tableName = 'users';

    /**
     * @var string $primaryKey
     */
    protected static string $primaryKey = 'id';

    /**
     * Names and types of table columns in the database
     * 
     * @var array $tableSchema
     */
    protected static array $tableSchema = [
                'name'     => self::DATA_TYPE_STR,
                'age'      => self::DATA_TYPE_INT,
                'address'  => self::DATA_TYPE_STR,
                'tax'      => self::DATA_TYPE_DECIMAL,
                'salary'   => self::DATA_TYPE_DECIMAL,
                'image'    => self::DATA_TYPE_STR,
    ];

    public function calculateSalary()
    {
        return $this->salary - ($this->salary * $this->tax /100);
    }
}