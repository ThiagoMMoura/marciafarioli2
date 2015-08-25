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
	}
	
	public function valida($post = TRUE){
		$where = array();
		if($post){
			$where = array('email'=>$this->input->post('email'),'senha'=>$this->input->post('senha'));
		}else{
			$where = array('email'=>$this->email,'senha'=>$this->senha);
		}
		$query = $this->db->get_where($this->dbtable,$where);
		
		if ($query->num_rows == 1) {
			$this->id = $query['id'];
			$this->nome = $query['nome'];
			$this->email = $query['email'];
			$this->idtipousuario = $query['idtipologin'];
			$this->sexo = $query['sexo'];
			$this->idfotoperfil = $query['idfotoperfil'];
			return TRUE;
		}else return FALSE;
	}
}
?>