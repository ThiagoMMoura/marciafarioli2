<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model{
	protected $dbtable;
	public $id;
	
	public function __construct(){
		parent::__construct();
		log_message('info', 'My Model Class Initialized');
	}
	
	public function PostVariaveis(){
		foreach($this as $coluna){
			if($this->input->post($coluna)) {
				log_message('info', 'Valor de coluna: '.$coluna);
				$this->$coluna = $this->input->post($coluna);
			}
		}
	}
	
	public function inserir($post = TRUE){
		if($post){
			$this->PostVariaveis();
		}
		$this->db->insert($this->dbtable,$this);
	}
	
	public function alterar($post = TRUE){
		if($post){
			$this->PostVariaveis();
		}
		$this->db->update($this->dbtable, $this, array('id' => $this->id));
	}
	
	public function selecionar($colunas = NULL,$where = NULL){
		if($colunas==NULL)$colunas = '*';
		if($where==NULL)$where = '';
		
		$this->db->select($colunas);
		$this->db->where($where);
		$query = $this->db->get($this->dbtable);
		return $query;
	}
}
?>
