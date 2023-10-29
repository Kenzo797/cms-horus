<?php

require_once "model/Preferences.php";

class ListPreferences
{
    private $html;
    private $items;

    public function __construct()
    {
        $this->html = file_get_contents('Layout/html/listPreferences.html');
        $this->items = '';
    }

    public function load()
    {
    
    }

    public function delete($params)
    {
        try
        {
          
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
        return;
    }
}