<?php
require_once 'database/TTransaction.php';

class Messages
{
    public static function save($param)
    {
        $conn = TTransaction::getConnection();
        $date = date("Y-m-d");
        $sql = "INSERT INTO messages SET name = :name, number = :number, message = :message, date = :date WHERE id = :id";

        $result = $conn->prepare($sql);
        $result->execute([
            ':id' => $param['id'],
            ':name' => $param['name'],
            ':number' => $param['number'],
            ':message' => $param['message'],
            ':date' => $param['date']
        ]);

        TTransaction::closeConnection();
    }

    public static function all()
    {
        $conn = TTransaction::getConnection();

        $result = $conn->query("SELECT * FROM 	messages ORDER BY id");
        TTransaction::closeConnection();
        
        return $result->fetchAll();
    }
}
