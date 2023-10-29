<?php
require_once 'database/TTransaction.php';

class HomeSectionFeatures
{

    public static function save($data)
    {
        $conn = TTransaction::getConnection();

        if(!empty($data['id']))
        {
             $sql = "UPDATE homesectionfeatures SET
                            title           = :title,
                            description     = :description
                            WHERE id        = :id";
        }
        else
        {   
            $result = $conn->query("SELECT max(id) as next FROM homesectionfeatures");
            $row = $result->fetch();
            $data['id'] = (int) $row['next'] + 1; 

            $sql = "INSERT INTO homesectionfeatures (id, title, description) 
                           VALUES (:id, :title, :description)";
        }
        $result = $conn->prepare($sql);
        $result->execute([':id'               => $data['id'], 
                          ':title'            => $data['title'],
                          ':description'      => $data['description']]);
        TTransaction::closeConnection();
        return $data;
    }

    public static function find($id)
    {
        $conn = TTransaction::getConnection();
        $result = $conn->prepare("SELECT * FROM homesectionfeatures WHERE id =:id");
        $result->execute([':id' => $id]);
        $data = $result->fetch(PDO::FETCH_ASSOC);
        TTransaction::closeConnection();
        return $data;
    }

    public static function getAll() 
    {
        $conn = TTransaction::getConnection();

        $result = $conn->query("SELECT * FROM homesectionfeatures ORDER BY id");
        $data = $result->fetchAll();
        TTransaction::closeConnection();
        return $data;
    }
    
    public static function delete($id)
    {
        $conn = TTransaction::getConnection();
        $result = $conn->prepare("DELETE FROM homesectionfeatures WHERE id =:id");
        $result->execute([':id' => $id]);
        TTransaction::closeConnection();
    }
}



