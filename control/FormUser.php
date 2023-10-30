<?php

require_once "model/User.php";
class FormUser 
{
  private $html;
  private $data;

  public function __construct()
  {
    $this->html = file_get_contents("Layout/html/user.html");
    $this->data = ['id'       => '',
                   'email'     => '',
                   'password'    => '',];
  }

  public function edit($params)  
  {
    try 
    {
      $id  = (int) $params['id'];
      $this->data = User::find($id);
    } 
    catch (Exception $e) 
    {
      return $e->getMessage();
    }  
  }

  public function save($params)
  {
    try 
    {
      $user = User::save($params);
      $this->data = $user;
      $result = "Pessoa salva com sucesso <br> <a href='index.php'>Volta para pagina inicial</a>";
      return  print $result; 
    } 
    catch (Exception $e) 
    {
      return $e->getMessage();
    }  
  }

  public function show()  
  {
    $this->html = str_replace('{id}',       $this->data['id'],       $this->html);
    $this->html = str_replace('{email}',     $this->data['email'],     $this->html);
    $this->html = str_replace('{password}',    $this->data['password'],    $this->html);

    print $this->html;
  } 
}