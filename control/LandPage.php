<?php

require_once 'model/Preferences.php';

class LandPage
{
    private $html;
    private $data;

    public function __construct()
    {
        $this->html  = file_get_contents("Layout/html/index.html");
    }

    public function load()
    {
        try 
        {
            $prefes = Preferences::getAll();
            
            foreach($prefes as $prefe)
            {
                return  $this->html = str_replace('{logoHeader}', $prefe['logoCabecalho'], $this->html);
            }
        }
        catch(Exception $e)
        {
            $e->getMessage();
        }
    }

    public function show()  
    {
        $this->load();
        return print $this->html;
    }
}