<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Usuario_model extends MY_Model {
    /**
     * @var string 
     */
    public $nome;
    /**
     * @var string 
     */
    public $email;
    /**
     * @var string 
     */
    public $senha;
    /**
     * @var string (Masculino,Feminino)
     */
    public $sexo;
    /**
     * @var int <b>Chave Estrangeira</b> 
     */
    public $idfotoperfil;
    /**
     * @var int <b>Chave Estrangeira</b> 
     */
    public $idnivel;

    public function __construct() {
        parent::__construct();
        $this->dbtable = 'usuario';
        $this->idnivel = $this->config->item('nivelusuariopadrao');
    }

    public function valida($post = TRUE) {
        $where = array();
        if ($post) {
            $where = array('email' => $this->input->post('email'), 'senha' => $this->input->post('senha'));
        } else {
            $where = array('email' => $this->email, 'senha' => $this->senha);
        }
        
        $this->selecionar('*', $where);

        return ($this->getNumRows() === 1);
    }
    
    /**
     * @deprecated since version 0.3 Substituido pelo metódo _logged de MY_Controller
     * @return boolean
     */
    public function isLogado() {
        if ($this->session->has_userdata('logado') && $this->session->logado) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    /**
     * Retorna o valor do nivel de hierarquia do usuário na sessão ou do usuário
     * passado por parâmentro.
     * 
     * @param int $id
     * @return int
     */
    public function get_hierarquia($id = NULL){
        if($id == NULL){
            $id = $this->session->idnivel;
        }
        $nivel = $this->nivel_model->getObjectById($id);
        return $nivel->hierarquia;
    }

}
