<?php

require_once  'model/User.php';

class ListUser
{

    private $html;
    private $items;

    public function __construct()
    {
        $this->html = file_get_contents('Layout/html/listUser.html');
        $this->items = '';
    }

    public function load()
    {
        try {
            $users = User::getAll();


            foreach ($users as $user) {
                $item = file_get_contents('Layout/html/userItem.html');

                $item = str_replace('{id}',     $user['id'],     $item);
                $item = str_replace('{email}',  $user['email'],  $item);

                $this->items .= $item;
            }

            return $this->html = str_replace('{items}', $this->items, $this->html);
        } catch (Exception $e) {
            return print $e->getMessage();
        }
    }

    public function delete($params)
    {
        try {
            $id = (int) $params['id'];
            User::delete($id);
            return header("Location: index.php?class=ListUser");
        } catch (Exception $e) {
            return print $e->getMessage();
        }
    }

    public function show()
    {
        $this->load();
        return print $this->html;
    }
}
