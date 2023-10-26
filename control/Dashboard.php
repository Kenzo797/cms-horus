<?php
class Dashboard
{
    private $html;

    public function __construct()
    {
        $this->html = file_get_contents("Layout/html/dashboard.html");
    }

    public function show()  
    {
        print $this->html;
    }
}