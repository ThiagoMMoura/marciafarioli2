<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Usuario_model extends MY_Model{
	
	public $nome;
	public $email;
	public $senha;
	public $idtipologin;
	public $sexo;
	public $idfotoperfil;
	
	public function __construct(){
		parent::__construct();
		$this->dbtable = 'usuario';
		$this->idtipologin = $this->config->item('tipousuariopadrao');
	}
	
	public function valida($post = TRUE){
		$where = array();
		if($post){
			$where = array('email'=>$this->input->post('email'),'senha'=>$this->input->post('senha'));
		}else{
			$where = array('email'=>$this->email,'senha'=>$this->senha);
		}
		$query = $this->db->get_where($this->dbtable,$where);
		
		if ($query->num_rows() == 1) {
			$row = $query->row_array();
			$this->id = $row['id'];
			$this->nome = $row['nome'];
			$this->email = $row['email'];
			$this->idtipousuario = $row['idtipologin'];
			$this->sexo = $row['sexo'];
			$this->idfotoperfil = $row['idfotoperfil'];
			return TRUE;
		}else return FALSE;
	}
}
?>