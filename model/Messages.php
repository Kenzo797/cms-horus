<?php
require_once 'database/TTransaction.php';

class Messages
{
    public static function save($param)
    {
        print_r($param);
        $conn = TTransaction::getConnection();

        if (empty($param['id'])) {
            $sql = "INSERT INTO messages (id, name, email, tel, message, date) 
                        VALUES (:id, :name, :email, :tel, :message, NOW())";
        } else {
            $result = $conn->query("SELECT max(id) as next FROM messages");
            $row = $result->fetch();
            $param['id'] = (int) $row['next'] + 1;
            $sql = "UPDATE messages SET 
                name = :name, 
                email = :email, 
                tel = :tel, 
                message = :message, 
                date = NOW() 
                WHERE id = :id";
        }

        $result = $conn->prepare($sql);
        $result->execute([
            ':id' => $param['id'],
            ':name' => $param['name'],
            ':email' => $param['email'],
            ':tel' => $param['tel'],
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
