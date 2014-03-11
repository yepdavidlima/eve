<?php
require_once("php/config.php");
header("Content-Type: text/html;charset=utf-8");
echo"<pre>";
$teste = new Eve\Admin();
try{
  /*
  $dados = Array(
    "nome" => "Dave",
    "email" => "david.lima@agenciayep.com",
    "login" => "dave.lima",
    "senha" => "yep313233",
    "status" => 1,
    "permissoes" => "*",
    "id" => 15
  );
  $teste->UpdateAdministrator($dados);*/
  $credenciais = Array(
    "login" => "dave.lima",
    "senha" => "123456"  
  );
  $teste->Login($credenciais);
}catch(Eve\EveException $e){
  echo "<p><b>Eve\EveException:</b></p>".$e->getMessage();
}catch(Exception $e){
  echo $e->getMessage();
}