<?php
class Tipo_login_model extends CI_Model{
	
	public $idtipologin;
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
	}
}
?>