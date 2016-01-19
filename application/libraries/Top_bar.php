<?php
/** 
 * @package	Application
 * @author	Thiago Moura
 * @since	Version 1.0.0
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


    public function __construct($menu_bar = array()) {
        $this->menu_bar = $menu_bar;
        $this->CI =& get_instance();
    }
    
    public function create($data = array()){
        if(!empty($data)){
            $data = $this->_remove_unnecessary_fields($data);
        }else{
            $data = $this->menu_bar;
        }
        
        $this->html = $this->CI->html->menu($this->menu_bar);
        
        return $this->html;
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
                    $arvore[$key] = $this->_remove_unnecessary_fields($value,FALSE);
                }
            }
        }
        
        if($replace_menu_bar){
            $this->menu_bar = $arvore;
        }
        return $arvore;
    }
    
    public function show(){
        echo $this->html;
    }
}
