<?php
class MY_Model extends CI_Model{
	protected $dbtable;
	public $id;
	
	public function __construct($dbtable){
		parent::__construct();
		$this->dbtable = $dbtable;
		log_message('info', 'My Model Class Initialized');
	}
	
	public function PostVariaveis(){
		foreach($this as $coluna){
			$this->$coluna = $this->input->post($coluna);
		}
		 /*show_error('Função PostVariaveis() não implementado.', EXIT__AUTO_MIN);*/
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
}
?>
