<?php declare(strict_types=1);

namespace app\traits;

use app\helpers\Transaction;
use app\lib\LoggerHTML;
use app\model\UsersModel;
use Exception;

trait UserTrait
{
    public function getUser()
    {
        $id = empty($_GET) ? $_SESSION['user-id'] : $_GET['id'];

        try {
            Transaction::open('db');
            Transaction::setLogger( new LoggerHTML('log.html') );

            $model = new UsersModel();
            $result = $model->find('id', $id);

            Transaction::close();

            if(!$result) {
                unset($_SESSION['user-id']);
                header('location: /login');
            }

            $html = file_get_contents(__DIR__ . '/../html/templates/user.html');
            $html = str_replace('[[IMG]]', '/assets/uploads/'.$result->photo, $html);
            $html = str_replace('[[NAME]]', $result->first_name .' '. $result->last_name, $html);
            $html = str_replace('[[STATUS]]', $result->status === 'true' ? 'Active Now' : 'Offline', $html);

            return $html;

        } catch( Exception $e ) {
            Transaction::log($e->getMessage());
            Transaction::rollback();

            unset($_SESSION['user-id']);
            header('location: /login');
        }
    }
}
