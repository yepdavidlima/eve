<?php
namespace Eve;

/**
 * Interface de conexão com bancos de dados. Todos os drivers de conexão devem seguir esta interface
 * @author David Lima
 * @copyright 2014, David Lima
 * @package System
 * @see \Eve\Connector
 */
interface DB{
  /**
   * Construtor - deve ser instanciado com um objeto PDO
   * @param \PDO $pdo
   */
  public function __construct(\PDO $pdo);
  
  /**
   * Método para inserção de dados no banco
   * @param string $tabela Tabela que receberá o insert
   * @param array $colunas Array de colunas utilizadas no insert
   * @param array $valores Array de valores correspondente as colunas do insert
   */
  public function insert($tabela, Array $colunas = Array(), Array $valores);
  
  /**
   * Realiza um update no banco de dados
   * @param string $tabela Tabela que receberá o update
   * @param array $valores Array de valores que serão atualizados
   * @param string $condicao Condição que deverá ser satisfeita para realização do update
   * @example update("`tabela1`",
   *                  Array("`coluna1` = 'valor'", "`coluna2`" = 'valor2'",
   *                  "`id` = 35"  
   *                )
   */
  public function update($tabela, Array $valores = Array(), $condicao = "");
  
  /**
   * Realiza um delete no banco de dados
   * @param string $tabela Tabela que receberá o delete
   * @param string $condicao Condição que deverá ser satisfeita para realização do delete
   * @param string $limite Limite de campos a serem apagados
   * @example delete("`tabela1`"
   *                  "id > 5",
   *                  10
   * )
   */
  public function delete($tabela, $condicao, $limite = "");
  
  /**
   * Realiza um select e retorna um conjunto de dados
   * @param string $tabela Tabela que será usada para o select
   * @param array $colunas Colunas que estarão no resultado
   * @param string $condicao Condição que deverá ser satisfeita para o select
   * @param string $limite Limite de linhas para o resultado do select
   */
  public function select($tabela, Array $colunas = Array("*"), $condicao = false, $limite = false);
}