<?php declare(strict_types=1);

namespace app\controller;

use app\model\LogoutModel;
use app\helpers\Transaction;
use app\lib\LoggerHTML;
use Exception;

class LogoutController
{
    public function __construct()
    {
        session_start();
    
        $id = $_SESSION['user-id'];
        $this->updateStatus($id, 'false');

        unset($_SESSION['user-id']);
        header('location: /login');
    }

    private function updateStatus($id, $status)
    {
        try {
            Transaction::open('db');
            Transaction::setLogger( new LoggerHTML('log.html') );

            $model = new LogoutModel();

            $result = $model->update('users', 'status', 'id', $id, $status);

            Transaction::close();

            return $result;

        } catch( Exception $e ) {

            Transaction::log($e->getMessage());
            Transaction::rollback();

            return false;
        }
    }
}
