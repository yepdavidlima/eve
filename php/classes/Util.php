<?php
namespace Eve;
class Util{
  public static function ArrayMergeSQL(Array &$array){
    foreach($array as $chave=>$valor){
      $valores[] = "`$chave` = '$valor'";
    }
    $array = $valores;
    unset($valores);
    return $array;
  }
}