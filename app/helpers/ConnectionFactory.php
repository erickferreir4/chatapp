<?php declare(strict_types=1);

namespace app\helpers;

use PDO;
use Exception;

/**
 *  Connection Factory
 */
final class ConnectionFactory
{
    private function __construct()
    {
    }

    /**
     *  Open ini file
     *  @param {string} $ini_file - ini file
     */
    public static function open(string $ini_file) : PDO
    {
        $file = __DIR__ . '/../config/' . $ini_file . '.ini';

        if( file_exists($file) ) {
            $config = parse_ini_file($file);
        }
        else {
            throw new Exception('Arquivo '.$file.' nao encontrado');
        }

        $user = isset($config['user']) ? $config['user'] : null;
        $pass = isset($config['pass']) ? $config['pass'] : null;
        $host = isset($config['host']) ? $config['host'] : null;
        $name = isset($config['name']) ? $config['name'] : null;
        $type = isset($config['type']) ? $config['type'] : null;

        switch($type) {
            case 'mysql';
                $conn = new PDO("mysql:host={$host};dbname={$name}", $user, $pass);
                break;
            case 'pgsql';
                $conn = new PDO("pgsql:dbname={$name};user={$user}; password={$pass}; host={$host}");
                break;
            case 'sqlite';
                $conn = new PDO("sqlite:{$name}");
                break;
        }

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    }
}
