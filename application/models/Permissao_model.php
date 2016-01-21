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
    public $idurl;
    /**
     * @var bool 
     */
    public $permite;
    
    public function __construct() {
        parent::__construct();
        $this->dbtable = 'permissao';
    }
    
    public function Novo($campos){
        $this->setCampos($campos);
        return parent::inserir(FALSE);
    }
    
    /**
     * Retorna <b>FALSE</b> caso não seja encontrado o registro no banco, senão,
     * retorna o valor booleano do campo no banco.
     * 
     * @param type $idnivel
     * @param type $idurl
     * @return boolean
     */
    public function has_permissao($idnivel = '',$idurl = ''){
        if($idnivel==NULL){
            $idnivel = $this->idnivel;
        }
        if($idurl==NULL){
            $idurl = $this->idurl;
        }
        if($idnivel!=NULL&&$idurl!=NULL){
            $this->selecionar('*', array('idnivel'=>$idnivel,'idurl'=>$idurl));
            if($this->getNumRows()==1){
                return $this->get_first_row()->permite;
            }
        }
        return FALSE;
    }
}
