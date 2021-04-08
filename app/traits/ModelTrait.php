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
                    photo VARCHAR(250),
                    status VARCHAR(100)

                );
                CREATE TABLE IF NOT EXISTS messages
                (
                    id INTEGER PRIMARY KEY,
                    sender INT(11) NOT NULL,
                    receiver INT(11) NOT NULL,
                    message VARCHAR(750) NOT NULL
                )'; 

        //Transaction::log($sql);

        self::$conn->exec($sql);
    }

    public function all($table)
    {
        $sql = "SELECT * FROM ".$table;

        $result = self::$conn->query($sql);

        //Transaction::log($sql);

        return $result->fetchAll(PDO::FETCH_CLASS, 'stdClass');
    }

    public function find($col, $search)
    {
        $sql = "SELECT * FROM users 
                WHERE
                    ".$col." = :".$col;

        $stmt = self::$conn->prepare($sql);

        $stmt->bindValue(':'.$col, $search);

        $stmt->execute();

        Transaction::log($sql);

        return $stmt->fetchObject();
    }

    public function update( $table, $col, $col_search, $search, $value )
    {
        $sql = "UPDATE ".$table."
                    SET ".$col." = :value
                    WHERE ".$col_search." = '".$search."'
                ";

        Transaction::log($sql);

        $stmt = self::$conn->prepare($sql);
        $stmt->bindValue(':value', $value);

        return $stmt->execute() ? true : false;
    }


}

