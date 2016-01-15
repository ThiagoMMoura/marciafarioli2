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
    /**
     * @var int <b>Chave Estrangeira</b> 
     */
    public $idnivel;
    /**
     * @var int <b>Chave Estrangeira</b> 
     */
    public $idrestricao;
    /**
     * @var bool 
     */
    public $permite;
    
    /**
     * @deprecated since version 1.0
     * @var int <b>Chave Estrangeira</b> 
     */
    public $idmenu;
    /**
     * @deprecated since version 1.0
     * @var bool 
     */
    public $consultar;
    /**
     * @deprecated since version 1.0
     * @var bool 
     */
    public $incluir;
    /**
     * @deprecated since version 1.0
     * @var bool 
     */
    public $editar;
    /**
     * @deprecated since version 1.0
     * @var bool 
     */
    public $excluir;
    
    public function __construct() {
        parent::__construct();
        $this->dbtable = 'permissao';
    }
    
    public function Novo($campos){
        $this->setCampos($campos);
        return parent::inserir(FALSE);
    }
}
