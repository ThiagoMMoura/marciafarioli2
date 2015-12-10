<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Classe que modela tabela Menu do Banco de Dados
 *
 * @author Thiago Moura
 */
class Menu_model extends MY_Model{
    public $nome;       //String
    public $descricao;  //String
    public $url;        //String
    public $grupo;      //String
    public $tipo;       //String
    public $formato;    //String
    public $nivel;      //INT
    public $ordem;      //INT
    public $idmenupai;  //INT FK
    public $sistema;    //Boolean
    
    public function __construct() {
        parent::__construct();
        $this->dbtable = 'menu';
    }
    
    public function Novo($campos){
        $this->setCampos($campos);
        return parent::inserir(FALSE);
    }
    
    public function NovoMenuSistema($campos){
        $campos['sistema'] = TRUE;
        return $this->Novo($campos);
    }
    
    public function NovoMenuSite($campos){
        $campos['sistema'] = FALSE;
        return $this->Novo($campos);
    }

}
