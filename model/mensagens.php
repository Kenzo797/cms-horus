<?php
require_once 'database/TTransaction.php';

class mensagens
{
    public function save ($param)
    {
        $conn = TTransaction::getConnection();

        $sql = "UPDATE mensagens SET nome = :nome, tel = :tel, msg = :msg, data = :data WHERE id = :id":

        $result = $conn->prepare($sql);
        $result->execute([':id' => $param['id'], ':nome' => $param['nome'], ':tel' => $param['tel'],
        ':msg' => $param['msg'], ':data' => $param['data']]);
    }
    public static function all()
    {
        $conn = TTransaction::getConnection();

        $result = $conn->query("SELECT * FROM mensagens ORDER BY id");
        return $result->fetchAll();
    }
}