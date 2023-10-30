<?php 

require_once 'model/HomeSectionFeatures.php';

class FormHomeSectionFeatures
{
    private $html;
    private $data;

    public function __construct()
    {
        $this->html     = file_get_contents("Layout/html/homeSectionFeatures.html");
        $this->data     = ['id'              => '',
                           'title'           => '',
                           'description'     => ''];
        $this->startSession();
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

    public function logout()
    {
        if(!isset($_SESSION)){
            session_start();
        }

        session_destroy();
        header("Location: index.php?class=Login");
    }
    public function edit($params)
    {
        try 
        {
            $id  = (int) $params['id'];
            $this->data = HomeSectionFeatures::find($id);
        }
        catch(Exception $e)
        {
            return  print $e->getMessage();
        }
    }

    public function save($params)
    {
        try 
        {
            $feature = HomeSectionFeatures::save($params);
            $this->data = $feature;
            return  header("Location: index.php?class=ListHomeSectionFeatures");
        } 
        catch (Exception $e) 
        {
            return print $e->getMessage();
        } 
      
    }

    public function show()  
    {
        $this->html = str_replace('{id}',                $this->data['id'],                $this->html);
        $this->html = str_replace('{title}',             $this->data['title'],             $this->html);
        $this->html = str_replace('{description}',       $this->data['description'],       $this->html);
        print $this->html;
    }
}


// TODO - colocar tudo em ingles até os arquivos    