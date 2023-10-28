<?php
require_once 'database/TTransaction.php';

class Testemunho 
{
    public function save ($param)
    {
        $conn = TTransaction::getConnection();

        $sql = "UPDATE testenhos SET nome = :nome, funcao = :funcao, titulo = :titulo, descricao = :descricao,
        foto = :foto, imgDeFundo = :imgDeFundo WHERE id = :id";
        
    }
}