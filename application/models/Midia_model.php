<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Midia_model extends MY_Model{
	
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
	
	public function Nova($campos){
		$this->setCampos($campos);
		$this->criado = date('Y-m-d H:i:s');
                $this->idusuario = $this->session->id;
                $this->setId(NULL);
		return parent::inserir(FALSE);
	}
	
	public function NovaImagem($campos){
		$campos['biblioteca'] = 'imagem';
		return $this->Nova($campos);
	}
	
	public function add_imagem_portfolio($campos,$url = '',$id_album = '',$alt = ''){
            if(!is_array($campos)){
                $nome = $campos;
                $campos = array();
                $campos['nome'] = $nome;
                $campos['url'] = $url;
                $campos['idalbum'] = $id_album;
                $campos['alt'] = $alt;
            }
            $campos['classificacao'] = 'portfolio';
            $campos['privado'] = FALSE;
            $campos['local'] = 1;
            return $this->NovaImagem($campos);
	}
        
        public function url_imagem_padrao($id){
            $this->getObjectById($id);
            return $this->url;
        }
}