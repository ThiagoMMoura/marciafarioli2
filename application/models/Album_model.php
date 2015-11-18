<?php
class Album_model extends MY_Model{
	
	public $nome;
	public $descricao;
	public $biblioteca;
	public $classificacao;
	public $url;
	public $privado;
	public $idusuario;
	public $idcapa;
	public $criado;
	
	public function __construct(){
		parent::__construct();
		$this->dbtable = 'album';
		$privado = TRUE;
	}
	
	public function Novo($campos){
		$this->setCampos($campos);
		$this->criado = date('Y-m-d H:i:s');
		return parent::inserir(FALSE);
	}
	
	public function NovoImagem($campos){
		$campos['biblioteca'] = 'imagem';
		return $this->Novo($campos);
	}
	
	public function NovoImagemPortfolio($campos){
		$campos['classificacao'] = 'portfolio';
		$campos['url'] = 'images/portfolio/'.date('Y').'/'.date('m').'/'.str_replace(' ','_',strtolower($campos['nome'])).'/';
		$campos['privado'] = FALSE;
		return $this->NovoImagem($campos);
	}
}
?>