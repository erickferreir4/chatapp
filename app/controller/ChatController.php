<?php declare(strict_types=1);

namespace app\controller;

use app\traits\TemplateTrait;
use app\lib\Assets;

class ChatController
{
    use TemplateTrait;

    public function __construct()
    {
        $this->setTitle('chat');
        $this->addAssets();
        $this->layout('Chat');
    }

    public function addAssets()
    {
        $this->setAssets( new Assets );
        $this->addCss('chat');

        //$this->setAssets(new AssetsCdn);
        //$this->addCss('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css');
    }
}
