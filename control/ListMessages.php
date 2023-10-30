<?php


require_once 'model/Messages.php';

class ListMessages 
{
    private $html;
    private $items;

    public function __construct()
    {
        $this->html = file_get_contents('Layout/html/listMessages.html');
        $this->items = '';
    }
    public function load()
    {
        try
        {
            $messages = Messages::getAll();

            foreach ($messages as $message)
            {
                $item = file_get_contents('Layout/html/messagesItem.html');

                $item = str_replace('{id}',       $message['id'],       $item);
                $item = str_replace('{name}',     $message['name'],     $item);
                $item = str_replace('{email}',    $message['email'],    $item);
                $item = str_replace('{tel}',      $message['tel'],      $item);
                $item = str_replace('{message}',  $message['message'],  $item);
                $item = str_replace('{date}',     $message['date'],     $item);

                $this->items .= $item;
            }
            return $this->html = str_replace('{items}', $this->items, $this->html);
        }
        catch (Exception $e)
        {
            return print $e->getMessage();
        }
    }
    public function delete($params)
    {
        try
        {
            $id = (int) $params['id'];
            Messages::delete($id);
            return header("Location: index.php?class=ListMessages");
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