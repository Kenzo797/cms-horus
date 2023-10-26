<?php 
require_once './database/TTransaction.php';

class Preferences  {
    public static function getAll()
    {
        $conn = TTransaction::getConnection();
        $result = $conn->query('SELECT * FROM preferencias');
        $data = $result->fetchAll();
        TTransaction::closeConnection();
        return  $data;
    }
}