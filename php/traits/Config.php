<?php
namespace Eve;

/**
 * Contém todas as configurações globais do sistema
 * @author David Lima
 * @copyright 2014, David Lima
 * @version dev 1.0
 * @package System
 */
trait Config{
  
  /**
   * Guarda as configurações de conexão com o banco de dados principal
   * @var array
   * @static
   */
  public static $database = Array(
    "type" => "MySQL", # Inicialmente o sistema só suporta conexões MySQL
    "server" => "",
    "database" => "",
    "user" => "",
    "password" => ""
  );
  
  /**
   * Guarda as variáveis de ambiente
   * @var array
   * @static
   */
  public static $environment = Array(
    "administrator_accounts_table" => "administradores",
    "password_hashing_cost" => 12
  );
  
  /**
   * Guarda as informações do cliente (website)
   * @var array
   * @static
   */
  public static $client = Array(
    "website" => "Nome do website",
    "url" => "http://localhost"  
  );
  
  /**
   * Guarda os diretórios padrões para upload de arquivos
   * Suporte para diretórios personalizados de acordo com a extensão: basta usar a extensão desejada como chave para o valor ("extensao" => "diretorio")
   * @var array
   * @static
   */
  public static $uploads = Array(
    "file_directory" => "uploads",
    "pdf" => "download"
  );
  
  /**
   * Guarda as configurações da conta do PagSeguro (não obrigatório)
   * @var array
   * @static
   */
  public static $pagseguro = Array(
    "api" => "php/externals/PagSeguroLibrary/PagSeguroLibrary.php",
    "email" => "david.lima@agenciayep.com",
    "token" => "372DA7C604A64843A30D6E0072CEF734"
  );
  
  public static $include_path = "";
}