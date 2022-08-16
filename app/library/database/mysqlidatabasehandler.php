<?php
namespace SEVENAJJY\LIBRARY\Database;

class MySQLiDatabaseHandler extends DatabaseHandler
{
    private static $_handler;

    private function __construct(){
        self::init();
    }

    protected static function init()
    {
        try {
            self::$_handler = new \PDO(
                'mysql://hostname=' . DATABASE_HOST_NAME . ';dbname=' . DATABASE_DB_NAME,
                DATABASE_USERNAME, DATABASE_PASSWORD
            );
        } catch (\PDOException $e) {

        }
    }

    public static function getInstance()
    {
        if(self::$_handler === null) {
            self::$_handler = new self();
        }
        return self::$_handler;
    }

    public function prepare()
    {

    }
}