<?php
require_once 'database/TTransaction.php';

class Depositions 
{

    public static function getAll()
    {
        $conn = TTransaction::getConnection();
        $result = $conn->query('SELECT * FROM depositions');
        $data = $result->fetchAll(PDO::FETCH_ASSOC); 
        TTransaction::closeConnection();
        return $data;
    }

    public static function save ($data)
    {
        $conn = TTransaction::getConnection();
        if(!empty($data['id']))
        {
             $sql = "UPDATE depositions SET
                            title           = :title,
                            function        = :function,
                            description     = :description,
                            photograph      = :photograph,
                            backgroundImage = :backgroundImage
                            WHERE id        = :id";
        }
        else
        {   
            $result = $conn->query("SELECT max(id) as next FROM depositions");
            $row = $result->fetch();
            $data['id'] = (int) $row['next'] + 1; 

            $sql = "INSERT INTO depositions (id, title, function, description, photograph, backgroundImage) 
                           VALUES (:id, :title, :function, :description, :photograph, :backgroundImage)";
        }

        $result = $conn->prepare($sql);
        $result->execute([':id'               => $data['id'], 
                          ':title'            => $data['title'],
                          ':function'         => $data['function'],
                          ':description'      => $data['description'],
                          ':photograph'       => $data['photograph'],
                          ':backgroundImage'  => $data['backgroundImage']]);
        
        TTransaction::closeConnection();
    }

    public static function find($id)
    {
        $conn = TTransaction::getConnection();
        $result = $conn->prepare("SELECT * FROM depositions WHERE id =:id");
        $result->execute([':id' => $id]);
        $data = $result->fetch(PDO::FETCH_ASSOC);
        TTransaction::closeConnection();
        return $data;
    }

    public static function delete($id)
    {
        $conn = TTransaction::getConnection();
        $result = $conn->prepare("DELETE FROM depositions WHERE id =:id");
        $result->execute([':id' => $id]);
        TTransaction::closeConnection();
    }
}