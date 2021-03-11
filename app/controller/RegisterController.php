<?php declare(strict_types=1);

namespace app\controller;

use app\traits\TemplateTrait;
//use app\lib\Assets;

class RegisterController
{
    use TemplateTrait;

    public function __construct()
    {
        $this->setTitle('Register');
        $this->addAssets();
        $this->layout('Register');
    }

    public function addAssets()
    {
        //$this->setAssets( new Assets );
    }
}

