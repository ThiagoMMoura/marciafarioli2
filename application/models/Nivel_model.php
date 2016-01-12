<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
 * Description of Nivel
 *
 * @author Thiago Moura
 */
class Nivel_model extends MY_Model {
    public $nome;            //String
    public $descricao;       //String
    public $hierarquia;      //INT Nivel de hierarquia
    
    public function __construct() {
        parent::__construct();
        $this->dbtable = 'nivel';
    }
    
    public function Novo($campos){
        $this->setCampos($campos);
        return parent::inserir(FALSE);
    }
}
