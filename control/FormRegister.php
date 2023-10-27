<?php 

require_once 'model/Preferences.php';

class FormRegister
{
    private $html;

    public function __construct()
    {
        $this->html = file_get_contents("Layout/html/register.html");
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

    public function show()  
    {
        $this->load();
        print $this->html;
    }
}