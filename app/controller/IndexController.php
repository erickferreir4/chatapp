<?php declare(strict_types=1);

namespace app\controller;

use app\traits\TemplateTrait;
use app\lib\Assets;

/**
 *  Index Controller
 */
class IndexController
{
    use TemplateTrait;

    public function __construct()
    {
        $this->addAssets();
        $this->setTitle('Home');
        $this->layout('Index');
    }

    public function addAssets()
    {
        //$this->setAssets( new Assets );

        //$this->addCss('style');
        //$this->addJs('index');
    }
}
