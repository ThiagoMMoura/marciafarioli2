<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
 * Description of Permissao_model
 *
 * @author Thiago Moura
 */
class Permissao_model extends MY_Model{
    public $idnivel;    //INT FK
    public $idmenu;     //INT FK
    public $nome;       //String única que identifica cada permissão
    public $consultar;  //Boolean
    public $incluir;    //Boolean
    public $editar;     //Boolean
    public $excluir;    //Boolean
    
    public function __construct() {
        parent::__construct();
        $this->dbtable = 'permissao';
    }
    
    public function Novo($campos){
        $this->setCampos($campos);
        return parent::inserir(FALSE);
    }
}
