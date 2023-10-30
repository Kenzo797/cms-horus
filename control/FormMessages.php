<?php


require_once "model/Messages.php";
class FormMessages
{
    private $html;
    private $data;

    public function __construct()
    {
        $this->startSession();
        $this->html = file_get_contents('Layout/html/messages.html');
        $this->data = [
            'id' => '',
            'name' => '',
            'email' => '',
            'tel' => '',
            'message' => ''
        ];
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

    public function save($param)
    {
        try {
            // print_r($param);
            Messages::save($param);
            return  header("Location: index.php?class=ListMessages");
        } catch (Exception $e) {
            return print $e->getMessage();
        }
    }
    public function edit($param)
    {
        try {
            $id  = (int) $param['id'];
            $this->data = Messages::find($id);
        } catch (Exception $e) {
            return  print $e->getMessage();
        }
    }
    public function show()
    {
        $this->html = str_replace('{id}',           $this->data['id'],       $this->html);
        $this->html = str_replace('{name}',         $this->data['name'],     $this->html);
        $this->html = str_replace('{email}',        $this->data['email'],    $this->html);
        $this->html = str_replace('{tel}',          $this->data['tel'],      $this->html);
        $this->html = str_replace('{message}',      $this->data['message'],  $this->html);
        // $this->html = str_replace('{date}',         $this->data['date'],     $this->html);
        print $this->html;
    }
}
