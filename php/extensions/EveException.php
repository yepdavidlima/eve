<?php
namespace Eve;

/**
 * Extensão da classe \Exception
 * @author David Lima
 * @copyright 2014, David Lima
 * @version final 1.0
 */
class EveException extends \Exception{
  public function __construct($message, $code=1){
    parent::__construct($message, $code);
  }
}