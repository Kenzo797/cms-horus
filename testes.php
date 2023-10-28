<?php 

require_once './database/TTransaction.php';

TTransaction::getConnection();
print "<pre>";
$dados = TTransaction::getTables();
print_r($dados);
TTransaction::closeConnection();