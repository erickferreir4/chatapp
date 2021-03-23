<?php declare(strict_types=1);

namespace app\controller;

use app\traits\TemplateTrait;
use app\traits\LoggedTrait;
use app\lib\Assets;
use Exception;

class UsersController
{
    use TemplateTrait;
    use LoggedTrait;

    public function __construct()
    {
        //session_start();
        //unset($_SESSION['user']);
        //var_dump($_SESSION);
        $this->logged();
        $this->setTitle('Users');
        $this->addAssets();
        $this->layout('Users');
    }

    public function addAssets()
    {
        $this->setAssets( new Assets );
        $this->addCss('users');
        $this->addJs('users');
    }

    public function getUser()
    {
        try {
        } catch( Exception $e) {
        }

    }
}


