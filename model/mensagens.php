<?php
require_once 'datebase/TTransaction.php';

class Mensagens
{
    public function save ($param)
    {
        $conn = TTransaction::getConnection();

        $sql = "UPDATE mensagens SET name = :name, number = :number, message = :message, date = :date WHERE id = :id":

        $result = $conn->prepare($sql);
        $result->execute([':id' => $param['id'], ':name' => $param['name'], ':number' => $param['number'],
        ':message' => $param['message'], ':date' => $param['date']]);
        TTransaction::closeConnection();
    }
    public static function all()
    {
        $conn = TTransaction::getConnection();

        $result = $conn->query("SELECT * FROM mensagens ORDER BY id");
        return $result->fetchAll();
        TTransaction::closeConnection();
    }
}