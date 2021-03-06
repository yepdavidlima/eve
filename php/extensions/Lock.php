<?php
namespace Eve;

/**
 * Módulo de segurança do sistema. Este módulo contém métodos estáticos para tratamento, conversão e filtragem de dados
 * @author David Lima
 * @copyright 2014, David Lima
 * @package Extension
 * @see Config
 */
class Lock{
  use Config;

  public static function Crypt(&$password){
    $opcoes = Array(
      "cost" => static::$environment['password_hashing_cost']  
    );
    $password = \password_hash($password, PASSWORD_BCRYPT, $opcoes);
    return $password;
  }
}