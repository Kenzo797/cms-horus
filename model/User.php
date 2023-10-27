<?php
require_once 'database/TTransaction.php';
class User
{
    public function save ($user)
    {
        $conn = TTransaction::getConnection();

        if(empty($user['id'])) {
            $result = $conn->query("SELECT max(id) as next FROM usuarios");
            $row = $result->fetch();
            $user['id'] = (int) $row['next'] +1;
            $sql = "INSERT INTO usuarios (id, login, senha
                VALUES ( :id, :login, :senha)";

        }
        else {
            $sql = "UPDATE usuarios SET login = :login, senha = :senha WHERE id = :id";
        }
        $result = $conn->prepare($sql);
        $result->execute([':id' => $user['id'],':login' => $user['login'],':senha' => $user['senha'] ]);
    }
    public static function all()
    {
        $conn = TTransaction::getConnection();
        $result = $conn->query("SELECT * FROM usuarios ORDER BY id");
        return $result->fetchAll();
    }
}