<?php
header("Content-Type: text/html;charset=utf-8");
ini_set("display_errors", 1);
error_reporting(E_ALL);
require_once("php/config.php");
$eve = new Eve\Admin();
$pagseguro = $eve->PagSeguro;
$produto1 = Array(
  "id" => "001",
  "description" => "Hello produto de teste world",
  "quantity" => 1,
  "amount" => 10.00,
  "weight" => 0,
  "shipping" => 0.0
);

$comprador = Array(
  "name" => "Fulano de tal",
  "email" => "fulano@fulanomail.com",
  "areaCode" => 11,
  "phone" => "23114555",
  "documentType" => "CPF",
  "document" => "31563531836"
);

$entrega = Array(
  "postalCode" => "09521310",
  "street" => "Av. Goiás",
  "number" => 269,
  "complement" => null,
  "district" => "Centro",
  "city" => "São Caetano do Sul",
  "state" => "SP",
  "country" => "BRA",
  "shippingType" => $pagseguro::SHIPPING_OTHER
);

try{
  $pagseguro->createRequest("abcd");
  $pagseguro->AddItem($produto1);
  $pagseguro->SetCustomer($comprador);
  $pagseguro->SetShipping($entrega);
  
  $url = $pagseguro->Checkout();

  echo$url;
}catch(PagSeguroServiceException $e){
  echo$e->getMessage();
}catch(Eve\EveException $e){
  echo$e->getMessage(); 
}catch(Exception $e){
  echo$e->getMessage(); 
}