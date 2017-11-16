<?php
namespace App\Models;
use Core\Database;
use PDO;

class User extends \Core\Model
{
    public $id;
    
    public $name;
    
    public $password;
    
    public $balance;
    


    public function getBalance() {
        return $this->balance;
    }
    
}