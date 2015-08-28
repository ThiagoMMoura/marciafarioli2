<?php
class Album_model extends MY_Model{
	
	public $id;
	public $titulo;
	public $descricao;
	public $idusuario;
	public $criado;
	
	public function __construct(){
		parent::__construct();
		$this->dbtable = 'album';
	}
}
?>