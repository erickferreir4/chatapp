<?php declare(strict_types=1);

namespace app\controller;

use app\traits\TemplateTrait;
use app\traits\LoggedTrait;
use app\lib\Assets;
use app\traits\UserTrait;

class UsersController
{
    use TemplateTrait;
    use LoggedTrait;
    use UserTrait;

    public function __construct()
    {
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
}


