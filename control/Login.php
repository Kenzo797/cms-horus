<?php
require_once 'model/Preferences.php';
require_once 'model/User.php';

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

    public function login($params)
    {   
        try {
            // print_r($params);
            if(isset($params['email']) and isset($params['password']))
            {
                if(strlen($params['email']) == 0)
                {
                    print "Preecha o email";
                } elseif ((strlen($params['password']) == 0))
                {
                    print "Preecha a senha";
                } else {
                    $res =  User::authenticate($params['email'], $params['password']);
                    print $res;
                } 

            }
        } catch (Exception $e) 
        {
            return print $e->getMessage();
        }
    }

    public function show()  
    {
        $this->load();
        return print $this->html;
    }
}