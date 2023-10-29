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
            $this->data['id'] = $dados[0]['id'];
            $this->data['name'] = $dados[0]['name'];
            $this->data['email'] = $dados[0]['email'];
            $this->data['number'] = $dados[0]['number'];
            $this->data['message'] = $dados[0]['message'];
            $this->data['date'] = $dados[0]['date'];

            foreach($dados as $dado)
            {
                $this->html = str_replace("{id}", $dado["id"], $this->html);
                $this->html = str_replace("{name}", $dado["name"], $this->html);
                $this->html = str_replace("{email}", $dado["email"], $this->html);
                $this->html = str_replace("{number}", $dado["number"], $this->html);
                $this->html = str_replace("{message}", $dado["message"], $this->html);
                $this->html = str_replace("{date}", $dado["date"], $this->html);
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
        }
        catch (Exception $e){
            print $e->getMessage();
        }
    }
    public function show()
    {
        $this->load();
        return print $this->html;
    }
}