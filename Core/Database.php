<?php
namespace Core;

use App\Config;

class Database
{
    private static $db = null;
    
    static function getInstance()
    {
        try {
            if (self::$db === null) {
                $dsn = 'mysql:host=' . Config::HOST . ';dbname=' . Config::DBNAME . ';charset=utf8';
                self::$db = new \PDO($dsn , Config::USERNAME, Config::PASSWORD, array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
            }
            return self::$db;
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }
}