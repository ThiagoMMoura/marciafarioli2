<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model{
	protected $dbtable;
	protected $dbcolunas;
	private $id;
	
	public function __construct(){
		parent::__construct();
	}
	
	public function PostVariaveis(){
		if($this->dbcolunas == NULL) $this->dbcolunas = $this->db->list_fields($this->dbtable);
		foreach($this->dbcolunas as $coluna){
			if($this->input->post($coluna)!=NULL) {
				$this->{$coluna} = $this->input->post($coluna);
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
