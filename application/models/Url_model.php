<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
 * Modela a tabela <b>url</b>
 *
 * @author Thiago Moura
 */
class Url_model extends MY_Model{
    /**
     * @var string 
     */
    public $nome;
    /**
     * @var string 
     */
    public $descricao;
    /**
     * @var string 
     */
    public $url;
    /**
     * @var bool 
     */
    public $restricao;
    
    public function __construct() {
        parent::__construct();
        $this->dbtable = 'url';
    }
    
    /**
     * Retorna um objeto com a url passada por parâmetro, caso não exista, retorna <b>NULL</b>.
     * 
     * @param string $url
     * @return /Url_model
     */
    public function get_object_by_url($url = ''){
        if($url==NULL){
            $url = $this->url;
        }
        if($url!=NULL){
            $this->selecionar('*',array('url' => $url));
            if($this->getNumRows()==1){
                return $this->get_first_row();
            }
        }
        return NULL;
    }
    
    /**
     * Retorna <b>FALSE</b> se a url não for encontrada, ou retorna o valor do campo
     * restrição relacionado ao registro da url.
     * 
     * @param string $url
     * @return boolean
     */
    public function has_restricao_for_url($url = ''){
        if($this->get_object_by_url($url)!=NULL){
            return $this->restricao;
        }
        return FALSE;
    }
    
    /**
     * Retorna <b>FALSE</b> se o registro não for encontrado, senão, retorna o valor
     * do campo restrição relacionado ao registro.
     * @param int $id
     * @return boolean
     */
    public function has_restricao($id = ''){
        if($id==NULL){
            $id = $this->getId();
        }
        
        if($id!=NULL){
            $this->getObjectById($id);
            return $this->restricao;
        }
        return FALSE;
    }
}
