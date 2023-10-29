<?php
require_once 'database/TTransaction.php';

class Messages
{
    public static function save($param)
    {
        $conn = TTransaction::getConnection();

        if(!empty($data['id']))
        {
            $date = date("Y-m-d");
            $sql = "INSERT INTO messages (id, name, tel, message, date) 
                            VALUES (:id, :name, :tel, :message, :date)";

        }
        else
        {
            $result = $conn->query("SELECT max(id) as next FROM messages");
            $row = $result->fetch();
            $data['id'] = (int) $row['next'] + 1;
            $sql = "UPDATE messages SET 
                    name = :name, 
                    tel = :tel, 
                    message = :message, 
                    date = :date 
                    WHERE id = :id";
        }
        
            $result = $conn->prepare($sql);
            $result->execute([':id' => $param['id'],
                                ':name' => $param['name'],
                                ':tel' => $param['tel'],
                                ':message' => $param['message'],
                                ':date' => $param['date']]);
                                
            TTransaction::closeConnection();

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
