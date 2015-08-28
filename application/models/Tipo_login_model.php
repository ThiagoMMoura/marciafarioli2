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
	public $editarhome;
	
	public function __construct(){
		parent::__construct();
		$this->dbtable = 'tipologin';
	}
	
}
?>