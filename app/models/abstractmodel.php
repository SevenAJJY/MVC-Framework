<?php

    namespace SEVENAJJY\Models ;
    use SEVENAJJY\LIBRARY\Database\DatabaseHandler;

    /**
     * Abstract Model 
     * @author  yassine El hajjy (SevenAJJY) <yassine.elhajjy@gmail.com>
     * 
     * @see https://github.com/SevenAJJY
     */

    class AbstractModel
    {

        /**
         * Types of data in the database.
         */
        const DATA_TYPE_BOOL    = \PDO::PARAM_BOOL;
        const DATA_TYPE_STR     = \PDO::PARAM_STR ;
        const DATA_TYPE_INT     = \PDO::PARAM_INT ;
        const DATA_TYPE_DATE = 5;
        const DATA_TYPE_DECIMAL = 4 ;

        const VALIDATE_DATE_STRING = '/^[1-2][0-9][0-9][0-9]-(?:(?:0[1-9])|(?:1[0-2]))-(?:(?:0[1-9])|(?:(?:1|2)[0-9])|(?:3[0-1]))$/';

        /**
         * @todo::  Check the valid dates in MYSQL to create a proper pattern.
         */
        const VALIDATE_DATE_NUMERIC = '^\d{6,8}$';
        const DEFAULT_MYSQL_DATE = '1970-01-01';
        


        /**
         * Bind a value to a parameter.
         * 
         * @param  \PDOStatement $stmt
         * @return void
         */
        private function prepareValues(\PDOStatement &$stmt):void
        {
            foreach (static::$tableSchema as $columnName => $type) {
                if ($type == 4) {
                    $sanitizedValue = filter_var($this->$columnName , FILTER_SANITIZE_NUMBER_FLOAT , FILTER_FLAG_ALLOW_FRACTION);
                    $stmt->bindValue(":{$columnName}" , $sanitizedValue ) ;
                }
                else {
                    $stmt->bindValue(":{$columnName}" ,$this->$columnName , $type ) ;
                }
            }
        }


        /**
         * Build Name Parameters SQL.
         * 
         * @return string
         */
        private static function buildNameParameterSQL():string
        {
            $namedParams = '';
            foreach (static::$tableSchema as $columnName => $type) {
                $namedParams .= $columnName . '=:' . $columnName . ', ' ;
            }
            return trim($namedParams , ', ') ;
        }


        /**
         *  method is used to add new records to a MySQL table.
         * 
         * @return bool
         */
        private function create():bool
        {
            $sql = 'INSERT INTO ' . static::$tableName . ' SET ' . self::buildNameParameterSQL();
            $stmt = DatabaseHandler::factory()->prepare($sql);
            $this->prepareValues($stmt);
            if ($stmt->execute()) {
                $this->{static::$primaryKey} = DatabaseHandler::factory()->lastInsertId();
                return true ;
            }
            return false;
        }


        /**
         * method is used to update existing records in a table.
         * 
         * @return bool
         */
        private function update():bool
        {
            $sql = 'UPDATE ' . static::$tableName . ' SET ' . self::buildNameParameterSQL() . ' WHERE ' . static::$primaryKey . '='. $this->{static::$primaryKey};
            $stmt = DatabaseHandler::factory()->prepare($sql);
            $this->prepareValues($stmt);
            return $stmt->execute();
        }


        /**
         * method used decides if you will add or update a record.
         * 
         * @param bool $primaryKeyCheck
         * @return bool
         */
        public function save($primaryKeyCheck = true):bool
        {
            if (false === $primaryKeyCheck) {
                return $this->create();
            }
            return $this->{static::$primaryKey} === null ? $this->create() : $this->update() ;
        }


        /**
         * method is used to delete records from a table.
         * 
         * @return mixed
         */
        public function delete():mixed
        {
            $sql = 'DELETE FROM ' . static::$tableName . ' WHERE ' . static::$primaryKey . '='. $this->{static::$primaryKey};
            $stmt = DatabaseHandler::factory()->prepare($sql);
            return $stmt->execute();
        }


        /**
         * method is used to fetch all data from the table.
         * 
         * @return array|false
         */
        public static function getAll():array|false
        {
            $sql = 'SELECT * FROM '. static::$tableName ;
            $stmt = DatabaseHandler::factory()->prepare($sql);
            $stmt->execute() ;
            if(method_exists(get_called_class(), '__construct')) {
                $results = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));
            } else {
                $results = $stmt->fetchAll(\PDO::FETCH_CLASS, get_called_class());
            }
            return (is_array($results) && !empty($results)) ? $results : false ;
        }


        /**
         * method is used to Fetch a single record from the database with the primary key.
         * 
         * @param mixed $pk primary key
         * @return mixed
         */
        public static function getByKey($pk):mixed
        {
            $sql = 'SELECT * FROM '. static::$tableName . ' WHERE ' . static::$primaryKey . '= "' . $pk .'"';
            $stmt = DatabaseHandler::factory()->prepare($sql);
            if($stmt->execute() === true)
            {
                if(method_exists(get_called_class(), '__construct')) {
                    $obj = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));
                } else {
                    $obj = $stmt->fetchAll(\PDO::FETCH_CLASS, get_called_class());
                }
                return !empty($obj) ? array_shift($obj) : false ;
            }
            return false ;
        }


        /**
         * method is used to fetch a single record from the database using a column or group of columns.
         * 
         * @param mixed $columns columns from a table
         * @return \ArrayIterator|false
         */
        public static function getBy($columns):\ArrayIterator|false
        {
            $whereClauseColumns = array_keys($columns);
            $whereClauseValues = array_values($columns);
            $whereClause = [];
            for ( $i = 0, $ii = count($whereClauseColumns); $i < $ii; $i++ ) {
                $whereClause[] = $whereClauseColumns[$i] . ' = "' . $whereClauseValues[$i] . '"';
            }
            $whereClause = implode(' AND ', $whereClause);
            $sql = 'SELECT * FROM ' . static::$tableName . '  WHERE ' . $whereClause;
            return static::get($sql, $options);
        }


        /**
         * method is used to fetch data from the database according to the query you type.
         * 
         * @param mixed $sql The SQL query
         * @param array $options exemple - array('columnName' => array(Employee::DATA_TYPE_?, Value))
         * @return \ArrayIterator|false
         */
        public static function get($sql, $options = array()):\ArrayIterator|false
        {
            $stmt = DatabaseHandler::factory()->prepare($sql);
            if (!empty($options)) {
                foreach ($options as $columnName => $type) {
                    if ($type[0] == 4) {
                        $sanitizedValue = filter_var($type[1], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                        $stmt->bindValue(":{$columnName}", $sanitizedValue);
                    } 
                    elseif ($type[0] == 5) {
                        if (!preg_match(self::VALIDATE_DATE_STRING, $type[1]) || !preg_match(self::VALIDATE_DATE_NUMERIC, $type[1])) {
                            $stmt->bindValue(":{$columnName}", self::DEFAULT_MYSQL_DATE);
                            continue;
                        }
                        $stmt->bindValue(":{$columnName}", $type[1]);
                    } 
                    else {
                        $stmt->bindValue(":{$columnName}", $type[1], $type[0]);
                    }
                }
            }
            $stmt->execute();
            if(method_exists(get_called_class(), '__construct')) {
                $results = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));
            } else {
                $results = $stmt->fetchAll(\PDO::FETCH_CLASS, get_called_class());
            }
            if ((is_array($results) && !empty($results))) {
                return new \ArrayIterator($results);
            };
            return false;
        }


        /**
         * method is used to fetch the first record from a set of records returned from the database according to the query you type.
         * 
         * @param mixed $sql The SQL query
         * @param array $options exemple - array('columnName' => array(Employee::DATA_TYPE_?, Value))
         * @return mixed
         */
        public static function getOne($sql, $options = array()):mixed
        {
            $result = static::get($sql, $options);
            return $result === false ? false : $result->current();
        }


        /**
         * method used to get Model Table name
         * @return mixed
         */
        public static function getModelTableName():mixed
        {
            return static::$tableName ;
        }


        /**
         * method used to get The number of records in a table from the database
         * @return mixed
         */
        public static function count():mixed
        {
            $callingClass = get_called_class();
            $sql = 'SELECT COUNT(*) c FROM ' . $callingClass::$tableName;
            $stmt = DatabaseHandler::factory()->prepare($sql);
            $stmt->execute();
            $count = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if(!empty($count)) {
                return $count[0]['c'];
            }
            return 0;
        }


        /**
         * method used to Calculates the grand total of a column containing numeric values. 
         * This function only works on columns of numeric types (INT, FLOAT...) and does not add NULL values.
         * @param mixed $expression column name
         * @return mixed
         */
        public static function sum($expression):mixed
        {
            $callingClass = get_called_class();
            $sql = 'SELECT SUM(' . $expression . ') s FROM ' . $callingClass::$tableName;
            $stmt = DatabaseHandler::factory()->prepare($sql);
            $stmt->execute();
            $count = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if(!empty($count)) {
                return $count[0]['s'];
            }
            return 0;
        }


        /**
         * method used to Fetch the last five records added to Database
         * @return \ArrayIterator|false
         */
        public static function getLatest():\ArrayIterator|false
        {
            $callingClass = get_called_class();
            $query = "SELECT * FROM " .$callingClass::$tableName ." ORDER BY ". $callingClass::$primaryKey . " DESC LIMIT 5";
            $stmt = DatabaseHandler::factory()->prepare($query);
            $stmt->execute();
            if(method_exists(get_called_class(), '__construct')) {
                $results = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));
            } else {
                $results = $stmt->fetchAll(\PDO::FETCH_CLASS, get_called_class());
            }
            if ((is_array($results) && !empty($results))) {
                return new \ArrayIterator($results);
            };
            return false;
        }
    }