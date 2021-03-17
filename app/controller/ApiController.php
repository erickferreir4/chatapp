<?php declare(strict_types=1);

namespace app\controller;
use app\helpers\FilterSingleton;

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
        var_dump($_POST);
        var_dump($_FILES);

        $first_name = FilterSingleton::chars($_POST['first-name']);
        $last_name = FilterSingleton::chars($_POST['last-name']);
        $email = FilterSingleton::chars($_POST['email']);
        $passwd = FilterSingleton::chars($_POST['passwd']);

        if(empty($first_name) || empty($last_name) || empty($email) || empty($passwd) ) {
            echo 'All fields are required!';
        }
        else if ( !FilterSingleton::email($email) ) {
            echo "$email - This is not a valid email!";
        }
        else if (empty($_FILES)) {
            echo "Please select an image file!";
        }


    }
}

