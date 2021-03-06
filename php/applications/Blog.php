<?php
namespace Eve;

/**
 * Módulo de extensão que provê uma interface de blog completa para o Eve
 * @author David Lima
 * @copyright 2014, David Lima
 * @version dev 1.0
 * @package Application
 * @see Connector
 * @uses Config
 * @todo Implementar gerenciamento de autores nos posts
 */
class Blog{
  use Config;
  
  // Filtros de seleção
  
  /**
   * Ignora qualquer filtro de seleção
   */
  const EVE_BLOG_ALLPOSTS = "all";
  
  /**
   * Filtro de seleção: retorna um único resultado baseado em Blog::$id
   */
  const EVE_BLOG_FETCHPOST_ID = "fetch_id";
  
  /**
   * Filtro de seleção: retorna um único resultado baseado em Blog::$slug
   */
  const EVE_BLOG_FETCHPOST_SLUG = "fetch_slug";
  
  /**
   * Filtro de seleção: retorna N resultados baseado em Blog::$sql
   */
  const EVE_BLOG_CUSTOM = "custom";
  
  /**
   * Armazena a instância PDO vinda de Eve\Connector
   * @var string $db
   * @see Connector()
   */
  public $db;
  
  /**
   * Id: Deve ser usado com o filtro de seleção Blog::EVE_BLOG_FETCHPOST_ID
   * @var integer $id
   */
  public $id;
  
  /**
   * Slug: Deve ser usado com o filtro de seleção Blog::EVE_BLOG_FETCHPOST_SLUG
   * @var string $slug
   */
  public $slug;
  
  /**
   * SQL: Deve ser usado com o filtro de seleção Blog::EVE_BLOG_CUSTOM
   * @var string $sql
   */
  public $sql;
  
  /**
   * Guarda as configurações para a geração de feeds RSS
   * @var array $config_rss;
   */
  public $config_rss;
  
  public function __construct(){
    $this->db = Connector::get(); # $this->db se torna uma instância de banco de dados no mesmo momento da instanciação da classe
    $this->config_rss = Array(
      "url" => "http://localhost/eve/debug.php",
      "description" => "huehueheu",
      "title" => "aehoo"
    );
  }
  
  /**
   * Cria um post com os dados contidos em $data
   * @param array $data
   * @return boolean
   * @uses Util::Slug()
   * @throws EveException
   * @access public
   */
  public function CreatePost(Array $data){
    /*
     * Assumindo que $data = Array(
     *  'title' => ?,
     *  'description' => ?,
     *  'body' => ?,
     *  'datetime' => ? (Y-m-d H:i:s)
     * )
     */
    
    self::CheckPostData($data);
    
    $cols = Array("title", "description", "body", "datetime", "slug");
    
    $data['slug'] = Util::Slug($data['title']);
    
    if(!$data['datetime'] instanceof \DateTime){
      $data['datetime'] = new \DateTime(); 
    }
    
    $data['datetime'] = $data['datetime']->format('Y-m-d H:i:s');
    
    $this->db->insert("blog", $cols, array_values($data));
    return true;
  }
  
  /**
   * Atualiza um determinado post no banco de dados
   * @param array $data array de dados para atualização
   * @return boolean
   * @throws EveException
   * @uses Util::Slug(), Util::ArrayMergeSQL()
   */
  public function UpdatePost(Array $data){
    /*
     * Assumindo que $data = Array(
     *  'title' => ?,
     *  'description' => ?,
     *  'body' => ?,
     *  'datetime' = ? (Y-m-d H:i:s),
     *  'id' => ?
     * )
     */
    $id = intval($data['id']);
    unset($data['id']);
    self::CheckPostData($data);
    $data['slug'] = Util::Slug($data['title']);
    
    if(!$data['datetime'] instanceof \DateTime){
      $data['datetime'] = new \DateTime();
    }
    
    $data['datetime'] = $data['datetime']->format('Y-m-d H:i:s');
    Util::ArrayMergeSQL($data);
    $this->db->update("blog", $data, "`id` = $id");
    return true;
  }
  
  /**
   * Remove todos os posts cujo ID esteja dentro de $ids
   * @param array $ids Array com todos os IDs a serem removidos
   * @return boolean
   * @throws EveException
   */
  public function RemovePost(Array $ids){
    $ids = implode(",", $ids);
    return $this->db->delete("blog", "`id` IN($ids)", false);
  }
  
  /**
   * Retorna um conjunto de posts baseados no filtro de seleção $type (vide constantes de filtro de seleção EVE_BLOG_*)
   * @return \PDOStatement
   * @param string $type Qualquer constante EVE_BLOG_* | filtro de seleção a ser utilizado
   * @throws EveException
   */
  public function View($type = self::EVE_BLOG_ALLPOSTS, $limit = false){
    switch($type){
    	case self::EVE_BLOG_ALLPOSTS: # Retorna todos os posts sem filtragem
    	default:
    	  return $this->ListPosts(false, $limit);
    	  break;
    	  
    	case self::EVE_BLOG_FETCHPOST_ID: # Retorna post com ID igual a $this->id
    	  if(!$this->id){
    	    throw new EveException("EVE_BLOG_FETCHPOST_ID: Você precisa definir Blog::\$id");
    	  }
    	  
    	  $sql = "WHERE `id` = $this->id";
    	  $limit = 1;
    	  return $this->ListPosts($sql, $limit);
    	  break;
    	  
    	case self::EVE_BLOG_FETCHPOST_SLUG: # Retorna post com o slug igual a $this->slug
    	  if(!$this->slug){
    	    throw new EveException("EVE_BLOG_FETCHPOST_SLUG: Você precisa definir Blog::\$slug");
    	  }
    	  $sql = "WHERE `id` = $this->id";
    	  $limit = 1;
    	  return $this->ListPosts($sql, $limit);
    	  break;
    	  
    	case self::EVE_BLOG_CUSTOM: # Retorna conjunto de posts que satisfaçam a especificação em $this->sql (Use com cuidado!)
    	  if(!$this->sql){
    	     throw new EveException("EVE_BLOG_CUSTOM: Você precisa definir Blog::\$sql");
    	  }
    	  return $this->ListPosts($this->sql, $limit);
    	  break;
    }
  }
  
  public function Feed($output = "json", $limit = false){
    $feed = $this->ListPosts("", $limit);
    switch($output){
    	case"json":
        $feed = json_encode($feed);
    	  break;
    	case"rss":
    	  $config = $this->config_rss;
    	  $config_website = Config::$client;
    	  $channel =
<<<RSS
<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
  <atom:link href="{$config['url']}" rel="self" type="application/rss+xml" />
  <title>{$config['title']}</title>
  <link>{$config['url']}</link>
  <description>{$config['description']}</description>
RSS;
        foreach($feed as $post){
          $channel .=
<<<RSS

  <item>
    <link>{$config_website['url']}/{$post['slug']}</link>
    <title>{$post['title']}</title>
    <description>{$post['description']}</description>
    <guid>{$config_website['url']}/{$post['slug']}</guid>
  </item>
RSS;
        }
        $channel .=
<<<RSS

 </channel>
</rss>
RSS;
        $feed = $channel;
    	  
    	  break;
    }
    return $feed;
  }
  
  /**
   * Valida os campos de $data contra a relação de campos obrigatórios. Lança uma EveException em caso de erro, caso contrário, retorna true
   * @param array $data Array de informações da postagem
   * @throws EveException
   * @return boolean
   * @access private
   */
  private static function CheckPostData(Array &$data){
    $required = Array("title" => "Título", "body" => "Corpo");
    $keys = array_keys($required);
    foreach($keys as $key){
      if(!isset($data[$key])||isset($data[$key])&&!$data[$key]){
        throw new EveException("Preencha o campo {$required[$key]}!"); 
      }
    }
    return true;
  }
  
  /**
   * Realiza uma consulta na tabela de publicações com base nos argumentos fornecidos. Não deve ser chamada diretamente
   * @param string $sql Container de cláusulas SQL
   * @param string $limit
   * @return mixed,array
   * @see Eve\Blog::View()
   * @access private
   */
  private function ListPosts($sql = "", $limit = false){
    return $this->db->select("blog", Array("*"), $sql, $limit)->fetchAll(\PDO::FETCH_ASSOC);
  }
}