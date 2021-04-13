<?php declare(strict_types=1);

namespace app\controller;

use app\traits\TemplateTrait;
use app\traits\LoggedTrait;
use app\lib\Assets;

/**
 *  Login Controller
 */
class LoginController
{
    use TemplateTrait;
    use LoggedTrait;

    public function __construct()
    {
        $this->logged();
        $this->setTitle('login');
        $this->addAssets();
        $this->layout('Login');
    }

    public function addAssets()
    {
        $this->setAssets( new Assets );
        $this->addJs('pass_toggle');
        $this->addJs('auth');
    }
}
