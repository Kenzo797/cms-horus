<?php


class Form
{
    private $html;
    private $data;

    public function __construct()
    {
        $this->html = file_get_contents("Layout/html/login.html");
        $this->data = ['id'      => '',
                       'login'   => '',
                       'email'   => ''];
    }

    public function show()  
    {
        print $this->html;
    }
}