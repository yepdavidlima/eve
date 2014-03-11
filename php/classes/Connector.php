<?php
namespace Eve;

/**
 * Provê uma instância singleton com os bancos de dados disponíveis
 * @author David Lima
 * @copyright 2014, David Lima
 * @version dev 1.0
 * @see Eve\Config
 * @package System
 */
class Connector{
  Use Config;
  public static $opened;
  public static $instance;
  public static $pdo;
  public static $type;
  
  /**
   * Retorna uma instância singleton de uma conexão com o banco
   * @see \Eve\Connector\connect()
   */
  public static function get(){
    self::connect();
    return self::$instance;
  }
  
  /**
   * Verifica se existe uma conexão aberta, caso não exista, cria uma nova com base nas configurações contidas em Config
   * @see \Eve\Config
   * @return mixed self::$instance
   */
  private static function connect(){
    if(!self::$opened){
      $DBConfig = static::$database; # Recupera as configurações de conexão com banco de dados
      $type = $DBConfig['type'];
      self::$instance = null; 
      self::$pdo = null;
      switch($type){
      	case"MySQL":
      	default:
      	  require_once("DB.MySQL.php");
      	  self::$pdo = new \PDO("mysql:server={$DBConfig['server']};dbname={$DBConfig['database']}", $DBConfig['user'], $DBConfig['password'], Array(
      	   \PDO::ATTR_PERSISTENT => true
      	  ));
      	  self::$instance = new MySQL(self::$pdo);
      	  break;
      	case"PgSQL":
      	  
      	  break;
      }
      self::$opened = true;
    }
    return self::$instance;
  }
}