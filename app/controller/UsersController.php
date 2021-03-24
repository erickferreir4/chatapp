<?php declare(strict_types=1);

namespace app\controller;

use app\traits\TemplateTrait;
use app\traits\LoggedTrait;
use app\lib\Assets;
use app\helpers\Transaction;
use app\lib\LoggerHTML;
use app\model\UsersModel;
use Exception;

class UsersController
{
    use TemplateTrait;
    use LoggedTrait;

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

    public function getUser()
    {
        $email = $_SESSION['user'];

        try {
            Transaction::open('db');
            Transaction::setLogger( new LoggerHTML('log.html') );

            $model = new UsersModel();
            $result = $model->find($email);

            Transaction::close();

            if(!$result) {
                unset($_SESSION['user']);
                header('location: /login');
            }

            $html = file_get_contents(__DIR__ . '/../html/templates/user.html');
            $html = str_replace('[[IMG]]', '/assets/uploads/'.$result->photo, $html);
            $html = str_replace('[[NAME]]', $result->first_name .' '. $result->last_name, $html);
            $html = str_replace('[[STATUS]]', 'Active Now', $html);

            return $html;

        } catch( Exception $e ) {
            Transaction::log($e->getMessage());
            Transaction::rollback();

            unset($_SESSION['user']);
            header('location: /login');
        }
    }
}


