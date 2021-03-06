<?php
namespace App\Controllers;

use Core\View;
use Core\Session;
use App\Models\User;

Class Users
{
    public function index() 
    {
        View::show("login.php");
    }
    
    public function login() 
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_REQUEST["name"];
            $password = $_REQUEST["password"];
            
            if (preg_match("/^[\w\d]{4,13}$/", $name) && preg_match("/^[\w\d!@#$%]{4,13}$/", $password)) {
                $user = User::findBy('name', $name);            
                if ($user && password_verify($password, $user->password)) {
                    Session::set('userId', $user->id, true);
                    header('Location:/');
                    die();
                } 
            }            
            header('Location:login');
        }
        
    }

    public function logout() 
    {
        Session::destroy();
        header('Location:login');
    }    
}
