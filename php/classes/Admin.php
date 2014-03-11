<?php
namespace Eve;
/**
 * Classe responsável por gerenciar os administradores e permissões de acesso dentro do sistema
 * @author David Lima
 * @copyright 2014, David Lima
 * @version dev 1.0
 * @uses Connector
 * @see Config
 * @package System
 * @final
 */
final class Admin{
  use Config;
  public $db;
  public $administrator_accounts_table;
  public function __construct(){
    $this->db = Connector::get(); # $this->db se torna uma instância de banco de dados no mesmo momento da instanciação da classe base Admin
    $this->administrator_accounts_table = static::$environment['administrator_accounts_table'];
  }
  
  /**
   * Cria uma nova conta de administrador
   * @param array $dados
   * @return boolean
   * @throws EveException
   */
  final public function AddAdministrator(Array &$dados){
    if($this->LoginRegistered($dados['login'])){
      throw new EveException("O login \"{$dados['login']}\" já existe. Tente outro login!"); 
    }
    Lock::Crypt($dados['senha']);
    $campos = Array(
      "nome", "email", "login", "senha", "status", "permissoes"  
    );
    $this->db->insert($this->administrator_accounts_table, $campos, array_values($dados));
    return true;
  }
  
  /**
   * Apaga uma determinada conta de administrador
   * @param integer $id ID do administrador a ser removido
   * @return boolean
   */
  final public function RemoveAdministrator($id){
    $id = intval($id);
    if($this->IdRegistered($id)){
      $this->db->delete($this->administrator_accounts_table, "`id` = $id", 1);
      return true;
    }
    throw new EveException("O administrador não existe.");
  }
  
  /**
   * Atualiza os dados de um determinado administrador
   * @param array $dados Deve conter os dados a serem atualizados
   * @return boolean
   * @throws EveException
   * @example UpdateAdministrator(Array("nome" => "Jack", "id" => 55));
   */
  final public function UpdateAdministrator(Array &$dados){
    $id = intval($dados['id']);
    if(!$this->IdRegistered($id)){
      throw new EveException("O administrador não existe."); 
    }
    unset($dados['id']);
    if(!password_get_info($dados['senha'])['algo']){
      Lock::Crypt($dados['senha']);
    }
    Util::ArrayMergeSQL($dados);
    $this->db->update($this->administrator_accounts_table, $dados, "`id` = $id");
    return true;
  }
  
  final public function Login(Array $credenciais){
    // Verifica se $credenciais['login'] e $credenciais['senha'] não estão setados ou são nulos
    if(!$credenciais['login']||!$credenciais['senha']){
      throw new EveException("Preencha todos os campos!"); 
    }
    $query = $this->db->select($this->administrator_accounts_table, Array("*"), "login = '".$credenciais['login']."'", 1);
    if($query->rowCount()){
      $info = $query->fetch();
      if(password_verify($credenciais['senha'], $info['senha'])){
        return true;
      }
    }
    throw new EveException("Usuário ou senha inválidos");
  }
  
  /**
   * Verifica se um determinado id de administrador já existe no banco de dados
   * @param integer $id ID do administrador em questão
   * @return boolean
   */
  final private function IdRegistered($id){
    return (boolean)$this->db->select($this->administrator_accounts_table, Array("id"), "`id` = $id", 1)->rowCount();
  }
  
  /**
   * Verifica se um determinado login de administrador já existe no banco de dados
   * @param string $login login do administrador em questão
   * @return boolean
   */
  final private function LoginRegistered($login){
    return (boolean)$this->db->select($this->administrator_accounts_table, Array("login"), "`login` = '$login'", 1)->rowCount();
  }
}