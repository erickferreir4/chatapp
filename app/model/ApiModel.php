<?php declare(strict_types=1);

namespace app\model;

use app\helpers\Transaction;
use app\traits\ModelTrait;
use PDO;

class ApiModel
{
    use ModelTrait;

    public function insert($data)
    {

        $sql = "INSERT INTO users
                    (email, first_name, last_name, passwd, photo, status)
                VALUES
                    (:email, :first_name, :last_name, :passwd, :photo, :status);";


        $stmt = self::$conn->prepare($sql);

        $stmt->bindValue(':email', $data->email);
        $stmt->bindValue(':first_name', $data->first_name);
        $stmt->bindValue(':last_name', $data->last_name);
        $stmt->bindValue(':passwd', password_hash($data->passwd, PASSWORD_DEFAULT));
        $stmt->bindValue(':photo', $data->file_name);
        $stmt->bindValue(':status', $data->status);

        Transaction::log($sql);

        return $stmt->execute() ? true : false;
    }

    public function insertMsg($data)
    {
        $sql = "INSERT INTO messages
                    (sender, receiver, message)
                VALUES
                    (:sender, :receiver, :message);";

        $stmt = self::$conn->prepare($sql);
        
        $stmt->bindValue(':sender', $data->sender);
        $stmt->bindValue(':receiver', $data->receiver);
        $stmt->bindValue(':message', $data->message);

        Transaction::log($sql);

        return $stmt->execute() ? true : false;
    }

    public function messages($data)
    {
        $sql = "SELECT * FROM messages
                WHERE
                    sender = :sender AND receiver = :receiver
                OR
                    sender = :receiver AND receiver = :sender";

        $stmt = self::$conn->prepare($sql);
        
        $stmt->bindValue(':sender', $data->sender);
        $stmt->bindValue(':receiver', $data->receiver);

        $stmt->execute();

        //Transaction::log($sql);

        return $stmt->fetchAll(PDO::FETCH_CLASS, 'stdClass');
    }
}
