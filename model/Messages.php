<?php
require_once 'database/TTransaction.php';

class Messages
{
    public static function save($param)
    {
        // print_r($param);
        $conn = TTransaction::getConnection();

        if (empty($param['id'])) {
            $sql = "INSERT INTO messages (name, email, tel, message, date) 
                        VALUES (:name, :email, :tel, :message, NOW())";
        } 

        $result = $conn->prepare($sql);
        $result->execute([
            ':name' =>    $param['name'],
            ':email' =>   $param['email'],
            ':tel' =>     $param['tel'],
            ':message' => $param['message']
        ]);

        TTransaction::closeConnection();
        return;
    }


    public static function getAll()
    {
        $conn = TTransaction::getConnection();

        $result = $conn->query("SELECT * FROM 	messages ORDER BY id");
        TTransaction::closeConnection();

        return $result->fetchAll();
    }
    public static function find($id)
    {
        $conn = TTransaction::getConnection();
        $result = $conn->prepare("SELECT * FROM messages WHERE id =:id");
        $result->execute([':id' => $id]);
        $data = $result->fetch(PDO::FETCH_ASSOC);
        TTransaction::closeConnection();

        return $data;
    }
    public static function delete($id)
    {
        $conn = TTransaction::getConnection();
        $result = $conn->prepare("DELETE FROM messages WHERE id =:id");
        $result->execute([':id' => $id]);
        TTransaction::closeConnection();
    }
}
