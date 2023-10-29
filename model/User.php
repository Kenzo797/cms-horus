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

    public static function authenticate($email, $password)
    {
        $conn = TTransaction::getConnection();

        $sql = "SELECT email, password FROM users WHERE email = :email";
        $result = $conn->prepare($sql);
        $result->execute([':email' => $email]);

        if ($result->rowCount() > 0) {
            $user = $result->fetch(PDO::FETCH_ASSOC);

            if (md5($password) == $user['password'])
            {
                return $user['email'];
            } else
            {
                throw new Exception("Senha incorreta");
            }
        }
        else
        {
            throw new Exception("Email ou senha incorretos");
        }
        TTransaction::closeConnection();
        return;
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