<?php
class Config_model extends CI_Model{
	
	public $id;
	public $nome;
	public $valor;	
	
	public function __construct(){
		parent::__construct();
		$this->declarar();
	}
	
	public function declarar(){
		$query = $this->db->get('config');
		foreach($query->result() as $row){
			$this->config->set_item($row->nome,$row->valor);
			log_message('info','CONFIG SET - '.$row->nome.' = '.$row->valor);
		}
	}
}
?>