<?php declare(strict_types=1);

namespace app\model;

use app\helpers\Transaction;
use PDO;

class ApiModel
{
    private static $conn;

    public function __construct()
    {
        $this->setConnection();
    }

    /**
     *  Set Connection
     *
     *  @return void
     */
    private function setConnection() : void
    {
        if( empty(self::$conn) ) {
            self::$conn = Transaction::get();
            $this->createTableUsers();
        }
    }

    /**
     *  Create table if not exists
     *
     *  @return void
     */
    private function createTableUsers() : void
    {
        $sql = 'CREATE TABLE IF NOT EXISTS users
                (
                    id INTEGER PRIMARY KEY,
                    email VARCHAR(250) NOT NULL,
                    first_name VARCHAR(250),
                    last_name VARCHAR(250),
                    passwd VARCHAR(250),
                    photo VARCHAR(250)
                )'; 

        Transaction::log($sql);

        self::$conn->exec($sql);
    }

    public function insert($data)
    {

        $sql = "INSERT INTO users
                    (email, first_name, last_name, passwd, photo)
                VALUES
                    (:email, :first_name, :last_name, :passwd, :photo);";


        $stmt = self::$conn->prepare($sql);

        $stmt->bindValue(':email', $data->email);
        $stmt->bindValue(':first_name', $data->first_name);
        $stmt->bindValue(':last_name', $data->last_name);
        $stmt->bindValue(':passwd', password_hash($data->passwd, PASSWORD_DEFAULT));
        $stmt->bindValue(':photo', $data->file_name);

        Transaction::log($sql);

        return $stmt->execute() ? true : false;
    }

    public function all()
    {
        $sql = "SELECT * FROM users";

        $result = self::$conn->query($sql);

        Transaction::log($sql);

        return $result->fetchAll(PDO::FETCH_CLASS, 'stdClass');
    }

    public function find($email)
    {
        $sql = "SELECT * FROM users 
                WHERE
                    email = :email";

        $stmt = self::$conn->prepare($sql);

        $stmt->bindValue(':email', $email);

        $stmt->execute();

        Transaction::log($sql);

        return $stmt->fetchObject();
    }


}
