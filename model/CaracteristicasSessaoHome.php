<?php
require_once 'database/TTransaction.php';

class CaracteristicasSessaoHome
{
    public function save ($param)
    {
        $conn = TTransaction::getConnection();

        $sql = "UPDATE caracteristicassessaohome SET title = :title, description = :description WHERE idCharacteristics = :idCharacteristics";

        $result = $conn->prepare($sql);
        $result->execute([':idCharacteristics' => $param['idCharacteristics'], 
        ':title' => $param['title'], ':description' => $param['description']]);
        TTransaction::closeConnection();
    }
    public static function all() 
    {
        $conn = TTransaction::getConnection();

        $result = $conn->query("SELECT * FROM caracteristicassessaohome ORDER BY idCharacteristics");
        return $result->fetchAll();
        TTransaction::closeConnection();
    }
}



