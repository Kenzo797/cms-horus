<?php
require_once 'database/TTransaction.php';

class CaracteristicasSessaoHome
{
    public function save ($param)
    {
        $conn = TTransaction::getConnection();

        $sql = "UPDATE caracteristicassessaohome SET titulo = :titulo, descricao = :descricao WHERE idCaracteristicas = :idCaracteristicas";

        $result = $conn->prepare($sql);
        $result->execute([':idCaracteristicas' => $param['idCaracteristicas'], 
        ':titulo' => $param['titulo'], ':descricao' => $param['descricao']]);
    }
    public static function all() 
    {
        $conn = TTransaction::getConnection();

        $result = $conn->query("SELECT * FROM caracteristicassessaohome ORDER BY idCaracteristicas");
        return $result->fetchAll();
    }
}



