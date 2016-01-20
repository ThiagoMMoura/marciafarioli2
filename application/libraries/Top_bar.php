<?php
/** 
 * @package	Application
 * @author	Thiago Moura
 * @since	Version 1.0.0
 * @version     0.3.1
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Menu
 *
 * @package	Application
 * @subpackage	Libraries
 * @author Thiago Moura
 */
class Top_bar {
    private $menu_bar;
    protected $CI;
    private $html;
    private $restricted_urls;


    public function __construct($menu_bar = array()) {
        $this->_remove_unnecessary_fields($menu_bar);
        $this->CI =& get_instance();
        $this->restricted_urls = NULL;
    }
    
    public function usar_urls_restritas($data){
        $this->restricted_urls = $data;
    }
    
    /**
     * Retorna o html do menu criado com o array passado por parâmetro.
     * 
     * @param array $data
     * @return string
     */
    public function criar($data = array()){
        if(!empty($data)){
            $data = $this->_remove_unnecessary_fields($data);
        }else{
            $data = $this->menu_bar;
        }
        
        if($this->restricted_urls!=NULL){
            $data =  $this->_remove_restrict_urls($data);
        }
        
        $this->html = $this->CI->html->menu($this->menu_bar);
        
        return $this->html;
    }
    
    private function _remove_restrict_urls($data = array(),$replace_menu_bar = TRUE){
        if(empty($data)){
            $data = $this->menu_bar;
        }
        
        $arvore = array();
        if(isset($data['url'])){
            $arvore = $data;
            foreach($this->restricted_urls as $url){
                if($data['url']==$url){
                    $arvore = array();
                    break;
                }
            }
        }else{
            foreach($data as $key => $value){
                if(is_numeric($key)){
                    $value = $this->_remove_restrict_urls($value, FALSE);
                    if(!empty($value)){
                        $arvore[] = $value;
                    }
                }
            }
        }
        
        if($replace_menu_bar){
            $this->menu_bar = $arvore;
        }
        return $arvore;
    }
    
    private function _remove_unnecessary_fields($data = array(),$replace_menu_bar = TRUE){
        if(empty($data)){
            $data = $this->menu_bar;
        }
        $arvore = array();
        foreach($data as $key => $value){
            if($key=='nome' OR $key=='url' OR $key=='tipo' OR $key=='formato' OR $key=='icone'){
                $arvore[$key] = $value;
            }elseif (is_numeric($key)) {
                if(is_array($value)){
                    $subarvore = $this->_remove_unnecessary_fields($value,FALSE);
                    if(!empty($subarvore)){
                        $arvore[] = $subarvore;
                    }
                }
            }
        }
        
        if($replace_menu_bar){
            $this->menu_bar = $arvore;
        }
        return $arvore;
    }
    
    /**
     * Imprime o html gerado pela classe.
     */
    public function imprimir(){
        echo $this->html;
    }
}
