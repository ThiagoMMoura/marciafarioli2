﻿<?php
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
	
	public function logado(){
		if($this->session->has_userdata('logado')&&$this->session->logado){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	public function get_permissoes(){
		$this->load->model('tipo_login_model');
		$where = array('id'=>$this->session->idtipologin);
		$query = $this->tipo_login_model->selecionar(NULL,$where);
		$row = $query->row(0,'Tipo_login_model');
		return $row;
	}
}
?>