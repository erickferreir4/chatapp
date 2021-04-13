<?php declare(strict_types=1);

namespace app\controller;

use app\traits\TemplateTrait;
use app\lib\Assets;
use app\traits\LoggedTrait;
use app\traits\UserTrait;

/**
 *  Chat Controller
 */
class ChatController
{
    use TemplateTrait;
    use UserTrait;
    use LoggedTrait;

    public function __construct()
    {
        if( empty($_GET) || $_GET['id'] === null || !is_numeric($_GET['id']) ) {
            header('location: /users');
        }

        $this->logged();
        $this->setTitle('chat');
        $this->addAssets();
        $this->layout('Chat');
    }

    public function addAssets()
    {
        $this->setAssets( new Assets );
        $this->addCss('chat');
        $this->addJs('chat');
    }
}
