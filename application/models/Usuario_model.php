<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Usuario_model extends CI_Model{
	
	/*
	private $idusuario;
	public $nome;
	public $email;
	public $senha;
	public $idtipousuario;
	public $sexo;
	public $idfotoperfil;
	*/
	private $permissoes;
	
	public function __construct(){
		parent::__construct();
		$this->load->model('tipo_login_model');
	}
	
	public function inserir(){
		$user['nome'] = $this->input->post('nome');
		$user['email'] = $this->input->post('email');
		$user['senha'] = $this->input->post('senha');
	}
	
}
?>