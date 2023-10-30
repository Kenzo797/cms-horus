<?php

require_once './database/TTransaction.php';
class Dashboard
{
    private $html;

    public function __construct()
    {
        $this->html = file_get_contents("Layout/html/dashboard.html");
    }

    public function startSession()
    {
        if(!isset($_SESSION)){
            session_start();
        }

        if(!isset($_SESSION['user']))
        {
            die("Você não está auth <a href='index.php?class=Login'>Faça o Login</a>");
        }
    }

    public function logout()
    {
        if(!isset($_SESSION)){
            session_start();
        }

        session_destroy();
        header("Location: index.php?class=Login");
    }
    
    public function load()
    {              
        $this->startSession();
        $lista = file_get_contents("Layout/html/content.html");
        $this->html = str_replace('{user}', $_SESSION['name'], $this->html);
        return $this->html = str_replace('{content}', $lista, $this->html);
    }

    public function show()  
    {
        $this->load();
        print $this->html;
    }
}