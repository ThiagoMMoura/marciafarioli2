<?php
class Midia_model extends MY_Model{
	
	public $id;
	public $nome;
	public $biblioteca;
	public $classificacao;
	public $url;
	public $alt;
	public $local;
	public $privado;
	public $idalbum;
	public $idusuario;
	public $criado;
	
	public function __construct(){
		parent::__construct();
		$this->dbtable = 'midia';
	}
}
?>