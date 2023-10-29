<?php
require_once 'model/Preferences.php';

class Login
{
    private $html;
    private $data;

    public function __construct()
    {
        $this->html = file_get_contents("Layout/html/login.html");
        $this->data = ['id'      => '',
                       'login'   => '',
                       'email'   => ''];
    }

    public function load()
    {
        try 
        {
            $preferences = Preferences::getAll();
            
            foreach($preferences as $preference)
            {
                return  $this->html = str_replace('{logo}', $preference['headerLogo'], $this->html);
            }
        }
        catch(Exception $e)
        {
           print $e->getMessage();
        }
    }

    public function show()  
    {
        $this->load();
        return print $this->html;
    }
}