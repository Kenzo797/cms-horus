<?php


require_once 'model/Messages.php';

class ListMessages 
{
    private $html;
    private $items;

    public function __construct()
    {
        $this->html = file_get_contents('FAZER A LISTA HTML');
        $this->items = '';
    }
    public function load()
    {
        try
        {
            $dados = Messages::all();

            foreach ($dados as $dado)
            {
                $item = file_get_contents('FAZER A LISTA HTML');

                $item = str_replace('{id}',       $pessoa['id'],       $item);
                $item = str_replace('{name}',     $pessoa['name'],     $item);
                $item = str_replace('{email}',    $pessoa['email'],    $item);
                $item = str_replace('{number}',   $pessoa['number'],   $item);
                $item = str_replace('{message}',  $pessoa['message'],  $item);
                $item = str_replace('{date}',     $pessoa['date'],     $item);

                $this->items .= $item;
            }
            return $this->html = str_replace('{items}', $this->items, $this->html);
        }
        catch (Exception $e)
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