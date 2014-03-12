<?php
namespace Eve;

/**
 * Implementação MySQL da interface DB. Provê um meio de conexão para CRUD com um banco de dados MySQL
 * @author David Lima
 * @copyright 2014, David Lima
 * @version 1.0 dev
 * @uses DB
 * @see Connector
 * @see Config
 * @package Extensions
 */
class MySQL implements DB{
  public $pdo;
  
  /**
   * Define $this->pdo como um objeto \PDO na instanciação da classe
   * @param \PDO $pdo
   * @return PDO
   */
  public function __construct(\PDO $pdo){
    $this->pdo = $pdo;
    return $pdo;
  }
  
  /**
   * (non-PHPdoc)
   * @see \Eve\DB::insert()
   */
  public function insert($tabela, Array $colunas = Array(), Array $valores){
    $totalColunas = count($colunas);
    $totalValores = count($valores);
    $interrogacoes = Array();
    $this->pdo->beginTransaction();
    for($i=1;$i<=$totalColunas;$i++){
      $interrogacoes[] = "?"; 
    }
    $interrogacoes = implode(",", $interrogacoes);
    $colunas = implode(",", $colunas);
    $query = $this->pdo->prepare("INSERT INTO $tabela ($colunas) VALUES ($interrogacoes)");
    if($query->execute($valores)){
      $this->pdo->commit();
      return true;
    }
    $this->pdo->rollBack();
    throw new EveException("Impossível executar MySQL Insert.");
  }
  
  /**
   * (non-PHPdoc)
   * @see \Eve\DB::update()
   */
  public function update($tabela, Array $valores = Array(), $condicao = ""){
    $valores = implode(",", $valores);
    $this->pdo->beginTransaction();
    $query = $this->pdo->exec("UPDATE $tabela SET $valores WHERE $condicao");
    if($query){
      $this->pdo->commit();
      return true;
    }
    $this->pdo->rollBack();
    throw new EveException("Impossível executar MySQL Update:".$this->pdo->errorInfo()[2]);
  }
  
  /**
   * (non-PHPdoc)
   * @see \Eve\DB::delete()
   */
  public function delete($tabela, $condicao, $limite = false){
    $this->pdo->beginTransaction();
    $limite = ($limite ? " LIMIT $limite" : "");
    $query = $this->pdo->exec("DELETE FROM $tabela WHERE $condicao$limite");
    if($query){
      $this->pdo->commit();
      return true; 
    }
    $this->pdo->rollBack();
    throw new EveException("Impossível executar MySQL Delete");
  }
  
  /**
   * (non-PHPdoc)
   * @see \Eve\DB::select()
   */
  public function select($tabela, Array $colunas = Array("*"), $condicao = false, $limite = false){
    $limite = ($limite ? " LIMIT $limite" : "");
    $colunas = implode(",", $colunas);
    $condicao = ($condicao ? " WHERE $condicao" : "");
    $query = $this->pdo->query("SELECT $colunas FROM $tabela$condicao$limite");
    if($query){
      return $query;
    }
    throw new EveException("Impossível executar MySQL Select");
  }
}