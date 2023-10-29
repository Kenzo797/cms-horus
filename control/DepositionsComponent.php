<?php 

require_once "model/Depositions.php";
class DepositionsComponent
{
    private $html;

    public function __construct()
    {
        $this->html  = file_get_contents("Layout/html/testemunhosContent.html");
    }

    public function load()
    {
        try 
        {
            $items = '';
            $testemunhos = Depositions::getAll();
            foreach($testemunhos as $testemunho)
            {
                $item = file_get_contents("Layout/html/testemunhosContentItem.html"); 
                $item = str_replace('{name}',            $testemunho['name'],            $item);
                $item = str_replace('{title}',           $testemunho['title'],           $item);
                $item = str_replace('{function}',        $testemunho['function'],        $item);
                $item = str_replace('{description}',     $testemunho['description'],     $item);
                $item = str_replace('{photograph}',      $testemunho['photograph'],      $item);
                $item = str_replace('{backgroundImage}', $testemunho['backgroundImage'], $item);

                $items .= $item;
            }

            return $this->html = str_replace("{items}", $items, $this->html);
        }
        catch(Exception $e)
        {
            $e->getMessage();
        }
    }

    public function get()  
    {
        $this->load();
        return  $this->html;
    }
}