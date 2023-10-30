<?php 

require_once "model/HomeSectionFeatures.php";

class ListHomeSectionFeatures
{
    private $html;
    private $items;

    public function __construct()
    {
        $this->html = file_get_contents('Layout/html/listHomeSectionFeatures.html');
        $this->items = '';
        $this->startSession();
    }

    public function load()
    {
        try
        {
            $features = HomeSectionFeatures::getAll();
            
            foreach ($features as $feature)
            {
                $item = file_get_contents('Layout/html/homeSectionFeaturesItem.html');

                $item = str_replace('{id}',                 $feature['id'],              $item);
                $item = str_replace('{title}',              $feature['title'],           $item);
                $item = str_replace('{description}',        $feature['description'],     $item);

                $this->items .= $item;
            }

            return $this->html = str_replace('{items}', $this->items, $this->html);
        }
        catch (Exception $e)
        {
            return print $e->getMessage();
        }
    
    }

    public function startSession()
    {
        if(!isset($_SESSION)){
            session_start();
        }

        if(!isset($_SESSION['user']))
        {
            die("Você não está auth <a href='index.php?class=Login'>Faça o Login</a>");
        }
    }
    public function delete($params)
    {
        try
        {
            $id = (int) $params['id'];
            HomeSectionFeatures::delete($id);
            return header("Location: index.php?class=ListHomeSectionFeatures");
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


// TODO - MUNDAR O TITULO DAS PAGE HTML