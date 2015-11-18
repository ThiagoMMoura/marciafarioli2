<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model{
	protected $dbtable;
	protected $dbcolunas;
	private $id;
	
	public function __construct(){
		parent::__construct();
	}
	
	public function getId(){
		return $this->id;
	}
	public function setId($sid){
		$this->id = $sid;
	}
	
	public function PostVariaveis(){
		if($this->dbcolunas == NULL) $this->dbcolunas = $this->db->list_fields($this->dbtable);
		foreach($this->dbcolunas as $coluna){
			if($this->input->post($coluna)!=NULL) {
				$this->{$coluna} = $this->input->post($coluna);
			}
		}
	}
	
	public function getCampos(){
		$cmp = array();
		if($this->dbcolunas == NULL) $this->dbcolunas = $this->db->list_fields($this->dbtable);
		foreach($this->dbcolunas as $coluna){
			if($this->{$coluna}!=NULL){
				$cmp[$coluna] = $this->{$coluna};
			}
		}
		return $cmp;
	}
	
	public function setCampos($campos){
		foreach($campos as $campo => $value){
			$this->{$campo} = $value;
		}
	}
	
	public function inserir($post = TRUE){
		if($post){
			$this->PostVariaveis();
		}
		return $this->db->insert($this->dbtable,$this->getCampos());
	}
	
	public function getInserido(){
		$query = $this->selecionar(NULL,'id = '.$this->db->insert_id());
		$result = $query->row_array();
		$this->setCampos($result);
		return $result;
	}
	
	public function alterar($post = TRUE){
		if($post){
			$this->PostVariaveis();
		}
		return $this->db->update($this->dbtable, $this->getCampos(), array('id' => $this->getId));
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
