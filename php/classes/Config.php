<?php
namespace Eve;

/**
 * Carrega todas as configurações globais do sistema
 * @author David Lima
 * @copyright 2014, David Lima
 * @version dev 1.0
 * @package System
 */
trait Config{
  public static $database = Array(
    "type" => "MySQL",
    "server" => "localhost",
    "database" => "eve",
    "user" => "root",
    "password" => "yep313233"
  );
  
  public static $environment = Array(
    "administrator_accounts_table" => "administradores",
    "password_hashing_cost" => 12
  );
  
  /**
   * Define os diretórios padrões para upload de arquivos
   * Suporte para diretórios personalizados de acordo com a extensão: basta usar a extensão desejada como chave para o valor ("extensao" => "diretorio")
   * @var @uploads
   * @static
   */
  public static $uploads = Array(
    "file_directory" => "uploads",
    "pdf" => "download"
  );
}