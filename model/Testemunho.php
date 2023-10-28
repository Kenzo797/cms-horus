<?php
require_once 'database/TTransaction.php';

class Testemunho 
{
    public function save ($param)
    {
        $conn = TTransaction::getConnection();

        $sql = "UPDATE testenhos SET name = :name, function = :function, title = :title, description = :description,
        photo = :photo, backgroundPhoto = :backgroundPhoto WHERE id = :id";
        TTransaction::closeConnection();
    }
}