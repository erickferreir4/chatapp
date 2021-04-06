<?php declare(strict_types=1);

namespace app\controller;

use app\traits\TemplateTrait;
use app\helpers\Transaction;
use app\lib\LoggerHTML;
use app\model\ApiModel;
use Exception;

/**
 *  Index Controller
 */
class IndexController
{
    use TemplateTrait;

    public function __construct()
    {

        //session_start();
        //unset($_SESSION['user-id']);
        //var_dump($_SESSION);
        //$this->test();
        $this->addAssets();
        $this->setTitle('Home');
        $this->layout('Index');

        $test = 'id=1';

        var_dump(explode('=', $test)[1]);
    }

    public function addAssets()
    {
        //$this->setAssets( new Assets );
        //$this->addCss('style');
        //$this->addJs('index');
    }

    public function test()
    {
        try {
            Transaction::open('db');
            Transaction::setLogger( new LoggerHTML('log.html') );

            $model = new ApiModel();
            $result = $model->all('messages');
            //$result = $model->find('id', 1);

            echo '<pre>';
            var_dump($result);

            Transaction::close();
        } catch( Exception $e ) {
            Transaction::log($e->getMessage());
            Transaction::rollback();
        }
    }
}
