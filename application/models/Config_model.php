<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Config_model extends MY_Model{
	
	public $nome;
	public $valor;	
	
	public function __construct(){
		parent::__construct();
		$this->dbtable = 'config';
		$this->declarar();
	}
	/*public function PostVariaveis(){
		$this->id = $this->input->post('nome');
		$this->nome = $this->input->post('nome');
		$this->valor = $this->input->post('valor');
	}*/
	public function declarar(){
		$query = $this->db->get($this->dbtable);
		
		foreach($query->result() as $row){
			$this->config->set_item($row->nome,$row->valor);
			log_message('info','CONFIG SET - '.$row->nome.' = '.$row->valor);
		}
	}
	
	
}
?>