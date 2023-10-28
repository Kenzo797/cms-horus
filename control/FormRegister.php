<?php 

require_once 'model/Preferences.php';
require_once 'model/User.php';
class FormRegister
{
    private $html;
    private $data;

    public function __construct()
    {
        $this->html = file_get_contents("Layout/html/register.html");
        $this->data = ['id'       => '',
                       'email'    => '',
                       'senha'    => ''];
    }

    public function load()
    {
        try 
        {
            $preferences = Preferences::getAll();
            
            foreach($preferences as $preference)
            {
                return  $this->html = str_replace('{logo}', $preference['logoCabecalho'], $this->html);
            }
        }
        catch(Exception $e)
        {
           print $e->getMessage();
        }
    }

    public function save($params)
    {
        try 
        {
            $pessoa = User::save($params);
            return  header("Location: index.php?class=Login");
        } 
        catch (Exception $e) 
        {
            return print $e->getMessage();
        }  
    }

    public function show()  
    {
        $this->load();
        print $this->html;
    }
}


// TODO - OLHAR A Mensagem de error e para colocar de forma correta no layout