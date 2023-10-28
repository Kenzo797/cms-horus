<?php


require_once "model/Messages.php";
class FormMessages 
{
    private $html;
    private $data;

    public function __construct()
    {
        $this->html = file_get_contents('Layout/html/index.html');
        $this->data = ['id' => null,
        'name' => null,
        'email' => null,
        'number' => null,
        'message' => null,
        'date' => null];
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
}