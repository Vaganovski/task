<?php
namespace App\Controllers;

use Core\View;
use Core\Session;
use App\Models\User;
use App\Models\Transaction;

Class Account
{
    public function index() 
    {
        $userId= Session::get('userId');
        
        if ($userId) {            
            $user = User::findBy('id', $userId);
            View::show("index.php",['balance' => $user->balance/100]);
        } else {
            header('Location:login');
        }
    }
    
    public function withdraw() 
    {        
        $userId= Session::get('userId');
        
        if ($userId) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_REQUEST["amount"]) && preg_match("/^\d+(\.\d{1,2})?$/", $_REQUEST["amount"])) {
                    $amount = $_REQUEST["amount"];
                    if ($amount > 0) {
                        $transaction = new Transaction($userId, -$amount);
                        $transaction->save();
                    }
                } else {

                }
            }
            header('Location:/');
        } else {
            header('Location:login');
        }
        
    }
    
}