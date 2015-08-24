<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tipo_login_model extends MY_Model{
	
	public $nome;
	public $descricao;
	public $comentar;
	public $postar;
	public $upmidia;
	public $editarusuario;
	public $inserirusuario;
	public $inserirtipousuario;
	public $editartipousuario;
	
	public function __construct(){
		parent::__construct();
		$this->dbtable = 'tipologin';
	}
	
	public function PostVariaveis(){
		foreach($this as $coluna){
			$this->$coluna = $this->input->post($coluna);
		}
		/*$this->nome;
		$this->descricao;
		$this->comentar;
		$this->postar;
		$this->upmidia;
		$this->editarusuario;
		$this->inserirusuario;
		$this->inserirtipousuario;
		$this->editartipousuario;*/
	}
}
?>