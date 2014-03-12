<?php
require_once("php/config.php");
header("Content-Type: application/xml;charset=utf-8");
$data = Array(
  "title" => "teste".rand(0,350),
  "description" => "huehuehue",
  "body" => "aehoo",
  "datetime" => false  
);
$teste = new Eve\Admin();
$teste->LoadApplication("Blog");
$teste->Blog->CreatePost($data);
echo $teste->Blog->Feed("rss");