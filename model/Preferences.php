<?php 
require_once './database/TTransaction.php';

class Preferences  {
    public static function getPrefe()
    {
        $conn = TTransaction::getConnection();
        $result = $conn->query('SELECT * FROM preferencias');
        return $result->fetchAll();
    }
}   