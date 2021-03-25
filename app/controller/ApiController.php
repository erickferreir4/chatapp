<?php declare(strict_types=1);

namespace app\controller;

use app\helpers\FilterSingleton;
use app\model\ApiModel;
use app\helpers\Transaction;
use app\lib\LoggerHTML;
use stdClass;
use Exception;

class ApiController
{
    public function __construct()
    {
		$path = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_SPECIAL_CHARS);
		$method = isset(explode('/', $path)[2]) ? explode('/', $path)[2] : '';

		if( method_exists($this, $method) ) {
			$this->$method();
		}

        die();
    }

    public function register()
    {
        $data = new stdClass;

        $file_type = $_FILES['file']['type'];
        $file_tmp = $_FILES['file']['tmp_name'];

        $data->file_name = time() . basename($_FILES['file']['name']);
        $data->first_name = FilterSingleton::chars($_POST['first-name']);
        $data->last_name = FilterSingleton::chars($_POST['last-name']);
        $data->email = FilterSingleton::chars($_POST['email']);
        $data->passwd = FilterSingleton::chars($_POST['passwd']);

        if(empty($data->first_name) || empty($data->last_name) || empty($data->email) || empty($data->passwd) ) {
            echo 'All fields are required!';
            die();
        }
        else if ( !FilterSingleton::email($data->email) ) {
            echo "$data->email - This is not a valid email!";
            die();
        }
        else if (empty($file_type) || !preg_match("/png|jpg|jpeg/", $file_type)) {
            echo "Please select an image file - jpeg, jpg, png!";
            die();
        }


        $uploaddir = '/var/www/html/app/assets/uploads/' . $data->file_name;
        if(move_uploaded_file($file_tmp, $uploaddir)) {
            echo $this->save($data);
        }
    }


    public function save($data)
    {
        try {
            Transaction::open('db');
            Transaction::setLogger( new LoggerHTML('log.html') );


            if($this->userExists($data->email)) {
                $result = 'User Exists!';
            }
            else {
                $model = new ApiModel();
                if($model->insert($data)){
                    $result = $model->find('email', $data->email);
                    session_start();
                    $_SESSION['user-id'] = $result->id;

                    $result = 'success';
                }
                else {
                    $result = 'Something went wrong!';
                }
            }

            Transaction::close();

            return $result;

        } catch( Exception $e ) {
            Transaction::log($e->getMessage());
            Transaction::rollback();

            return 'Something went wrong!';
        }
    }

    public function userExists($email)
    {
        try {
            Transaction::open('db');
            Transaction::setLogger( new LoggerHTML('log.html') );

            $model = new ApiModel();
            $result = $model->find('email', $email);

            Transaction::close();

            return $result;

        } catch( Exception $e ) {

            Transaction::log($e->getMessage());
            Transaction::rollback();

            return false;
        }
    }

    public function login()
    {
        $data = new stdClass;

        $data->email = FilterSingleton::chars($_POST['email']);
        $data->passwd = FilterSingleton::chars($_POST['passwd']);

        $result = $this->userExists($data->email);
        if($result) {
            if(password_verify($data->passwd, $result->passwd)) {
                session_start();
                $_SESSION['user-id'] = $result->id;
                echo 'success';
            }
            else {
                echo 'Password incorrect!';
            }
        }
        else {
            echo 'User does not exist!';
        }
    }

    public function users()
    {
        try {
            Transaction::open('db');
            Transaction::setLogger( new LoggerHTML('log.html') );

            $model = new ApiModel();
            $result = $model->all();

            Transaction::close();

            session_start();
            $user_id = $_SESSION['user-id'];

            $users = '';

            foreach($result as $user) {
                if($user->id === $user_id) continue;

                $html = file_get_contents(__DIR__ . '/../html/templates/users.html');
                $html = str_replace('[[IMG]]', '/assets/uploads/'.$user->photo, $html);
                $html = str_replace('[[NAME]]', $user->first_name . ' ' .$user->last_name, $html);
                $html = str_replace('[[URL]]', '/chat?id='.$user->id, $html);
                $users .= $html;
            }

            echo strlen($users) ? $users : 'No users are available to chat';


        } catch( Exception $e ) {
            Transaction::log($e->getMessage());
            Transaction::rollback();

            echo 'No users are available to chat';
        }
    }


    public function chat()
    {
        $data = new stdClass;

        $data->sender = FilterSingleton::chars($_POST['user-sender']);
        $data->receiver = FilterSingleton::chars($_POST['user-receiver']);
        $data->message = FilterSingleton::chars($_POST['message']);

        try {

            Transaction::open('db');
            Transaction::setLogger( new LoggerHTML('log.html') );

            $model = new ApiModel();

            echo $model->insertMsg($data) ? true : false;

            Transaction::close();

        } catch( Exception $e ) {
            Transaction::log($e->getMessage());
            Transaction::rollback();
        }

    }
}

