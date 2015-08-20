<?php
class Midia_model extends CI_Model{
	
	public $id;
	public $nome;
	public $titulo;
	public $descricao;
	public $url;
	public $local;
	public $dtup;
	
	public function __construct(){
		parent::__construct();
	}
}
?>