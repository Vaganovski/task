<?php
namespace Core;
use PDO;


class Model
{
    public function __construct($data=[]) {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }
    
    public static function __callStatic($name, $arguments) {
        if (preg_match("/^findBy(?P<field>\w+)$/", $name, $matches)) {
            $field = lcfirst($matches['field']);
            $table = static::class;
            $table = lcfirst(substr($table, strrpos($table, '\\') + 1));
            $db = Database::getInstance();
            $stmt = $db->prepare("SELECT * FROM ".$table."s WHERE ".$field." = :".$field);
            $stmt->bindParam(":".$field, $arguments[0]);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                $user = new self($data);
                return $user;
            }

            return $data;            
        }
    }
}