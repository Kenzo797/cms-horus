<?php
require_once 'database/TTransaction.php';
class User
{
    public static function save($user)
    {
        $conn = TTransaction::getConnection();

        if(empty($user['id'])) 
        {
            $userExist = $conn->prepare("SELECT * FROM users WHERE email = :email");
            $userExist->execute([':email' => $user['email']]);

            if($userExist->rowCount() == 0) 
            {
                $result = $conn->query("SELECT max(id) as next FROM users");
                $row = $result->fetch();

                $user['id'] = (int) $row['next'] + 1;
                $hashedPassword = md5($user['password']);

                $sql = "INSERT INTO users (id, email, password)
                               VALUES ( :id, :email, :password)";
            }
            else 
            {
                throw new Exception("Este e-mail já está cadastrado.");
            }
        }
        else 
        {
            $sql = "UPDATE users SET email = :email, password = :password WHERE id = :id";
        }
        $result = $conn->prepare($sql);
        $result->execute([':id' => $user['id'],':email' => $user['email'],':password' => $hashedPassword ]);
        TTransaction::closeConnection();
    }

    public static function all()
    {
        $conn = TTransaction::getConnection();
        $result = $conn->query("SELECT * FROM users ORDER BY id");
        $result->fetchAll();
        TTransaction::closeConnection();
        return;
    }
}