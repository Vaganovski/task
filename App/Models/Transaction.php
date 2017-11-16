<?php
namespace App\Models;
use Core\Database;
//use PDO;

class Transaction extends \Core\Model
{
    
    protected $userId;
    
    protected $amount;
    
    public function __construct($userId, $amount) {
        $this->userId = $userId;
        $this->amount = $amount;

    }


    public function save() {
        if (isset($this->userId) && isset($this->amount)) {
            
            $this->amount = round($this->amount, 2);
            $db = Database::getInstance();
            try {
                $db->beginTransaction();
                $stmt = $db->prepare("SELECT balance FROM users WHERE id = :userId FOR UPDATE");
                $stmt->bindParam(':userId', $this->userId);
                $stmt->execute();

                $balance = $stmt->fetch()[0];
                $nb = $balance + $this->amount;

                if ($nb >= 0) {

                    $stmt = $db->prepare("INSERT INTO transactions (user_id, amount) VALUES (:userId, :amount)");
                    $stmt->bindParam(':userId', $this->userId);
                    $stmt->bindParam(':amount', $this->amount);
                    $stmt->execute();
                    $balance = $balance + $this->amount;

                    $stmt = $db->prepare("UPDATE users SET balance = :balance WHERE id=:userId");
                    $stmt->bindParam(':userId', $this->userId);
                    $stmt->bindParam(':balance', $balance);
                    $stmt->execute();

                }

                $db-> commit();
            } catch (Exception $e) {
                $db->rollBack();
                echo "Error: " . $e->getMessage();
            }
        }
        
    }
    
}

