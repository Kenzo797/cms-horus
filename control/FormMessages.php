<?php


require_once "model/Messages.php";
class FormMessages 
{
    private $html;
    private $data;

    public function __construct()
    {
        
        $this->html = file_get_contents('Layout/html/index.html');
        $this->data = ['id' => '',
        'name' => '',
        'email' => '',
        'number' => '',
        'message' => '',
        'date' => ''];
    }
    public function load ()
    {
        try{
            $dados = Messages::getAll();
            $this->data['id'] =      $dados['id'];
            $this->data['name'] =    $dados['name'];
            $this->data['email'] =   $dados['email'];
            $this->data['number'] =  $dados['number'];
            $this->data['message'] = $dados['message'];
            $this->data['date'] =    $dados['date'];

            foreach($dados as $dado)
            {
                $this->html = str_replace("{id}",      $dado["id"],      $this->html);
                $this->html = str_replace("{name}",    $dado["name"],    $this->html);
                $this->html = str_replace("{email}",   $dado["email"],   $this->html);
                $this->html = str_replace("{number}",  $dado["number"],  $this->html);
                $this->html = str_replace("{message}", $dado["message"], $this->html);
                $this->html = str_replace("{date}",    $dado["date"],    $this->html);
            }
        }
        catch (Exception $e) {
            print $e->getMessage();
        }
    }
    public static function save($param)
    {
        try{
            $this->data = Messages::save($param);
            print "mensagem salva";
            return  header("Location: index.php?class=ListMessages");
        }
        catch (Exception $e){
            print $e->getMessage();
        }
    }
    public function edit($params)
    {
        try 
        {
            $id  = (int) $params['id'];
            $this->data = Messages::find($id);
        }
        catch(Exception $e)
        {
            return  print $e->getMessage();
        }
    }
    public function show()
    {
        $this->load();
        return print $this->html;
    }
}