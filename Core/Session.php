<?php
namespace Core;

use App\Config;

class Session 
{ 
    public static function set($key, $value, $auth = false) 
    {
        self::_init();
        if ($auth) {
            self::_regenerate();
        }
        $_SESSION[$key] = $value;
        self::_age();
        session_write_close();
    }

    public static function get($key) 
    {
        self::_init();
        self::_age(); 
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        session_write_close();
        return false;
    }
     
    public static function delete($key) 
    {
        self::_init();
        unset($_SESSION[$key]);
        self::_age();
        session_write_close();
    }
    
    public static function start() 
    {
        return self::_init();
    }
    
    private static function _age() 
    {
        $last = isset($_SESSION['LAST_ACTIVE']) ? $_SESSION['LAST_ACTIVE'] : false ;
        
        if ($last !== false && (time() - $last > Config::SESSION_INACTIVE)){
            self::destroy();
        } else {
            if ($_SESSION['CREATED']< time()-Config::SESSION_REGENERATE) {
                self::_regenerate();
            }
            $_SESSION['LAST_ACTIVE'] = time();
        }
    }

    public static function destroy() 
    {
        if ( session_id() !== '' ) {
            $_SESSION = array();
            session_destroy();
        }
    }

    private static function _init() 
    {
        if ( session_id() === '' ) {
            session_start();
            if (isset($_SESSION['destroyed']) && $_SESSION['destroyed'] < time() - 300) {
                $_SESSION = array();
                throw new \Exception("Attempt to use old session");                        
            }
        }        
    }
    
    private static function _regenerate() 
    {
        $_SESSION['DESTROYED'] = time();
        session_regenerate_id();
        unset($_SESSION['DESTROYED']);
        $_SESSION['CREATED'] = time();        
    }

}