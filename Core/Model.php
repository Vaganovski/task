<?php
namespace Core;

class Model
{
    
    public static function findBy($field, $value) 
    {
        if (is_string($field)) {
            $table = static::class;
            $table = lcfirst(substr($table, strrpos($table, '\\') + 1));
            $db = Database::getInstance();
            $stmt = $db->prepare("SELECT * FROM ".$table."s WHERE ".$field." = :".$field);
            $stmt->bindParam(":".$field, $value);
            $stmt->execute();
            $stmt->setFetchMode(\PDO::FETCH_CLASS, static::class);
            $user = $stmt->fetch();

            return $user;
       
        } 
        return false;   
    }
}