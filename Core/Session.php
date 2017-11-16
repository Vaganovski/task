<?php
namespace Core;
use App\Config;

class Session
{
    

    public static function set($key, $value)
    {
        self::_init();
        $_SESSION[$key] = $value;
        self::_age();
        session_write_close();
        return $value;
    }

    public static function get($key)
    {
        self::_init();
        if (isset($_SESSION[$key]))
        {
            $value = $_SESSION[$key];
            self::_age();                        
            session_write_close();
            return $value;

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
        
        if ($last !== false && (time() - $last > Config::SESSION_LIFETIME))
        {
            self::destroy();
        }
        $_SESSION['LAST_ACTIVE'] = time();
    }
    
    
    public static function close()
    {
        if ( session_id() !== '' )
        {
            return session_write_close();
        }
        return true;
    }

    public static function destroy()
    {
        if ( session_id() !== '' )
        {
            $_SESSION = array();
            session_destroy();
        }
    }

    private static function _init()
    {

        if ( session_id() === '' )
        {
            return session_start();
        }

        return session_regenerate_id(true);
    }

}