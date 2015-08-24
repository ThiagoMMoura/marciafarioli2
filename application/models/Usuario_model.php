<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Usuario_model extends MY_Model{
	
	public $nome;
	public $email;
	public $senha;
	public $idtipousuario;
	/*public $sexo;
	public $idfotoperfil;
	*/
	private $permissoes;
	
	public function __construct(){
		parent::__construct();
		$this->dbtable = 'usuario';
	}
	
}
?>