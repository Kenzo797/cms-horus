<?php
require_once "model/HomeSectionFeatures.php";

class HomeFeaturesComponent
{
    private $html;

    public function __construct()
    {
        $this->html  = file_get_contents("Layout/html/home.html");
    }

    public function load()
    {
        try 
        {
            $items = '';
            $features = HomeSectionFeatures::getAll();
            foreach($features as $features)
            {
                $item = file_get_contents("Layout/html/itemHome.html"); 
                $item = str_replace('{title}',           $features['title'],           $item);
                $item = str_replace('{description}',     $features['description'],     $item);
                
                $items .= $item;
            }

            return $this->html = str_replace("{homeContainer}", $items, $this->html);
        }
        catch(Exception $e)
        {
            $e->getMessage();
        }
    }


    public function get()
    {
        $this->load();
        return $this->html;
    }
}
