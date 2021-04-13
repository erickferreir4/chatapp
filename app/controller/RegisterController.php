<?php declare(strict_types=1);

namespace app\controller;

use app\traits\TemplateTrait;
use app\traits\LoggedTrait;
use app\lib\Assets;

/**
 *  Register Controller
 */
class RegisterController
{
    use TemplateTrait;
    use LoggedTrait;

    public function __construct()
    {
        $this->logged();
        $this->setTitle('Register');
        $this->addAssets();
        $this->layout('Register');
    }

    public function addAssets()
    {
        $this->setAssets( new Assets );
        $this->addJs('pass_toggle');
        $this->addJs('auth');
    }
}

