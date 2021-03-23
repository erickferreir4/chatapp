<?php declare(strict_types=1);

namespace app\traits;

trait LoggedTrait
{
    public function logged()
    {
        session_start();
        
        $url = $_SERVER['REQUEST_URI'];

        if(isset($_SESSION['user']) && ($url === '/login' || $url === '/register')) {
            header('location: /users');
        }
        else if (!isset($_SESSION['user']) && $url === '/users') {
            header('location: /login');
        }
    }
}
