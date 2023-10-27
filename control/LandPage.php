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
            $preferences = Preferences::getAll();
            foreach($preferences as $preference)
            {
                $this->html = str_replace('{logoHeader}', $preference['logoCabecalho'], $this->html);
                $this->html = str_replace('{facebook}', $preference['linkFacebook'], $this->html);
                $this->html = str_replace('{instagram}', $preference['linkInstagram'], $this->html);
            }
        }
        catch(Exception $e)
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