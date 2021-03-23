<?php declare( strict_types=1 );

namespace app\traits;

use app\helpers\Transaction;
use PDO;

trait ModelTrait
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

