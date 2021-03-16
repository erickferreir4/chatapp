<?php declare(strict_types=1);

namespace app\controller;

use app\traits\TemplateTrait;
use app\lib\Assets;

class UsersController
{
    use TemplateTrait;

    public function __construct()
    {
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


