<?php declare(strict_types=1);

namespace app\controller;

class LogoutController
{
    public function __construct()
    {
        session_start();
        unset($_SESSION['user']);
        header('location: /login');
    }
}
