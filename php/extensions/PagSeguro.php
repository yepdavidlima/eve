<?php
namespace Eve;
/**
 * Implementação da biblioteca PagSeguro ao Eve
 * @author David Lima
 * @copyright 2014, David Lima
 * @version dev 0.1
 * @package Extensions
 * @see Config
 */
class PagSeguro{
  use Config;
  
  /**
   * Moeda usada para cobrança
   * @var string
   */
  const CURRENCY = "BRL";
  
  /**
   * Serviços de cobrança de frete
   * @var integer
   */
  const SHIPPING_PAC = 1,
        SHIPPING_SEDEX = 2,
        SHIPPING_OTHER = 3;
  
  /**
   * Credenciais de autenticação com o servidor PagSeguro
   * @var \PagSeguroAccountCredentials
   * @access private
   * @static
   */
  private static $credentials; # Será private quando houver a implementação da camada de abstração
  
  /**
   * Lista de produtos a serem comprados
   * @var array
   * @access private
   */
  private $products = Array();
  
  /**
   * Dados do comprador
   * @var array
   * @access private
   */
  private $customer = Array();
  
  /**
   * Dados de entrega
   * @var array
   * @access private
   */
  private $shipping = Array();
  
  /**
   * Pedido
   * @var \PagSeguroPaymentRequest
   */
  private $paymentRequest;
  
  /**
   * Código de referencia do pedido
   * @var string
   */
  private $ref = false;
  
  /**
   * Carrega a biblioteca PagSeguro
   * @throws EveException
   */
  public function __construct(){
    if(file_exists(Config::$pagseguro['api'])){
      require_once(Config::$pagseguro['api']);
      self::$credentials = new \PagSeguroAccountCredentials(Config::$pagseguro['email'], Config::$pagseguro['token']);
    }else{
      throw new EveException("Erro fatal: o módulo PagSeguro não pôde ser carregado."); 
    }
  }
  
  /**
   * Cria novo pedido de compra (caso exista um pedido não registrado, será sobrescrito)
   * @param $ref string Código de referência do pedido
   * @return boolean
   */
  public function createRequest($ref = false){
    $this->paymentRequest = new \PagSeguroPaymentRequest();
    if($ref){
      $this->ref = $ref;
      $this->paymentRequest->setReference($this->ref); # @TODO Habilitar opção de utilizar $this->ref
    }
    $this->paymentRequest->setCurrency(self::CURRENCY);
    return true; 
  }
  
  /**
   * Define o tipo de cobrança do frete
   * @param integer $type
   */
  public function setShippingType($type){
    if(!$this->paymentRequest){
      $this->createRequest($this->ref);
    }
    return $this->paymentRequest->setShippingType($type);
  }
  
  /**
   * Adiciona um item para compra em $this->products
   * @param array $item
   * @return boolean
   * @throws EveException|\PagSeguroServiceException|\Exception
   */
  public function AddItem(Array $item = Array()){
    if(!$this->paymentRequest){
      $this->createRequest($this->ref); 
    }
    
    return $this->paymentRequest->addItem(
      $item['id'],
      $item['description'],
      $item['quantity'],
      $item['amount'],
      $item['weight'],
      $item['shipping']
    );
  }
  
  /**
   * Define o comprador responsável pelo pedido
   * @param array $customer
   * @return boolean
   */
  public function SetCustomer(Array $customer = Array()){
    if(!$this->paymentRequest){
      $this->createRequest($this->ref);
    }
    
    return $this->paymentRequest->setSender(
      $customer['name'],
      $customer['email'],
      $customer['areaCode'],
      $customer['phone'],
      $customer['documentType'], # CPF | CNPJ
      $customer['document']
    );
  }
  
  /**
   * Define o endereço de entrega do pedido
   * @param array $shipping
   * @return boolean
   */
  public function SetShipping(Array $shipping = Array()){
    if(!$this->paymentRequest){
      $this->createRequest($this->ref); 
    }
    
    if(isset($shipping['shippingType'])&&$shipping['shippingType']){
      $this->setShippingType($shipping['shippingType']); 
    }
    
    return $this->paymentRequest->setShippingAddress(
      $shipping['postalCode'],
      $shipping['street'],
      $shipping['number'],
      $shipping['complement'],
      $shipping['district'],
      $shipping['city'],
      $shipping['state'],
      $shipping['country']  
    );
  }
  
  /**
   * Realiza o checkout do pedido
   * Este deve ser o último método invocado
   * @return string
   * @throws EveException|\Exception
   */
  public function Checkout(){
    if($this->paymentRequest){
      return $this->paymentRequest->register(self::$credentials);
    }
    throw new EveException("Você precisa preencher os dados da compra antes de finalizar o pedido");
  }
}