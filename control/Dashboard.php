<?php

require_once './database/TTransaction.php';
class Dashboard
{
    private $html;

    public function __construct()
    {
        $this->html = file_get_contents("Layout/html/dashboard.html");
    }
    
    public function load()
    {              
        $lista = file_get_contents("Layout/html/content.html");
        return $this->html = str_replace('{content}', $lista, $this->html);
    }

    public function show()  
    {
        $this->load();
        print $this->html;
    }
}