<?php declare(strict_types=1);

namespace app\controller;

use app\traits\TemplateTrait;
use app\lib\Assets;

class LoginController
{
    use TemplateTrait;

    public function __construct()
    {
        $this->setTitle('login');
        $this->addAssets();
        $this->layout('Login');
    }

    public function addAssets()
    {
        $this->setAssets( new Assets );
        $this->addJs('pass_toggle');

        //$this->setAssets(new AssetsCdn);
        //$this->addCss('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css');
    }
}
