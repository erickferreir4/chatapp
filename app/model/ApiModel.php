<?php declare(strict_types=1);

namespace app\model;

use app\helpers\Transaction;
use app\traits\ModelTrait;

class ApiModel
{
    use ModelTrait;

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
}
