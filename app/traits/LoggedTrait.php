<?php declare(strict_types=1);

namespace app\traits;

/**
 *  Logget Trait
 */
trait LoggedTrait
{
    /**
     *  Check is logged user
     */
    public function logged()
    {
        session_start();
        
        $path = $_SERVER['REQUEST_URI'];
        $url = strtolower(preg_split('/(\/|\?)/', $path)[1]);

        if(isset($_SESSION['user-id']) && ($url === 'login' || $url === 'register')) {
            header('location: /users');
        }
        else if (!isset($_SESSION['user-id']) && ($url === 'users' || $url === 'chat')) {
            header('location: /login');
        }
    }
}
