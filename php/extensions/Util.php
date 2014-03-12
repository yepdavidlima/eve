<?php
namespace Eve;

/**
 * Contém uma série de métodos de tratamento de dados e utilidades
 * @author David Lima
 * @copyright 2014, David Lima
 * @version dev 1.0
 * @package Extension
 */
class Util{
  /**
   * Transforma um array (chave => valor) em uma array associativa preparada para um MySQL Update (indice => "chave = 'valor'")
   * @param array $array Array de dados para o MySQL Update
   * @return string
   * @example ArrayMergeSQL(Array("teste" => "a", "teste2" => "b")) retorna Array(0 => "`teste` = 'a', 1 => `teste2` = 'b'")
   */
  public static function ArrayMergeSQL(Array &$array){
    foreach($array as $chave=>$valor){
      $valores[] = "`$chave` = '$valor'";
    }
    $array = $valores;
    unset($valores);
    return $array;
  }
  
  /**
   * Transforma uma string comum em uma slug
   * @param string $string String a ser transformada
   * @return string
   * @example Slug("Lorem Ipsum as dolor sit amet") retorna "lorem-ipsum-as-dolor-sit-amet"
   */
  public static function Slug($string){
    $in = Array(
        "á", "à", "â", "ã", "ä",
        "é", "è", "ê", "ë",
        "í", "ì", "î", "ï",
        "ó", "ò", "ô", "õ", "ö",
        "ú", "ù", "û", "ü",
        "ý", "ÿ",
        "'", '"', " - ", " ", ":", "\\", "\/", "!", "?", "*", "~", "#", "$", "¨", "\&",
        "ç"
    );
    $out = Array(
        "a", "a", "a", "a", "a",
        "e", "e", "e", "e",
        "i", "i", "i", "i",
        "o", "o", "o", "o", "o",
        "u", "u", "u", "u",
        "y", "y",
        "-", "-", "-", "-", "-", "", "", "", "", "", "", "", "", "", "e",
        "c"
    );
    $string = str_replace($in, $out, $string);
    $string = strtolower($string);
    
    return $string;
  }
}