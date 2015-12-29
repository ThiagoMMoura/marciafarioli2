﻿<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Usuario_model extends MY_Model{
	
	public $nome;           //String
	public $email;          //String
	public $senha;          //String
	public $idtipologin;
	public $sexo;
	public $idfotoperfil;   //INT FK
        public $idnivel;        //INT FK
	
	public function __construct(){
		parent::__construct();
		$this->dbtable = 'usuario';
		$this->idtipologin = $this->config->item('tipousuariopadrao');
                $this->idnivel = $this->config->item('tipousuariopadrao');
	}
	
	public function valida($post = TRUE){
		$where = array();
		if($post){
			$where = array('email'=>$this->input->post('email'),'senha'=>$this->input->post('senha'));
		}else{
			$where = array('email'=>$this->email,'senha'=>$this->senha);
		}
		$query = $this->db->get_where($this->dbtable,$where);
		
		if ($query->num_rows() == 1) {
			$row = $query->row_array();
			$this->setId($row['id']);
			$this->nome = $row['nome'];
			$this->email = $row['email'];
			$this->idtipousuario = $row['idtipologin'];
			$this->sexo = $row['sexo'];
			$this->idfotoperfil = $row['idfotoperfil'];
                        $this->idnivel = $row['idnivel'];
			return TRUE;
		}else return FALSE;
	}
	
	public function isLogado(){
		if($this->session->has_userdata('logado')&&$this->session->logado){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	public function verificaUsuario($redireciona = TRUE){
		if($this->isLogado()){
			return TRUE;
		}else{
			if($redireciona){
				$this->session->set_flashdata('alerta','error_login_necessario');
				redirect('login');
			}else return FALSE;
		}
	}
	
	public function get_permissoes(){
		$this->load->model('tipo_login_model');
		$where = array('id'=>$this->session->idtipologin);
		$this->tipo_login_model->selecionar(NULL,$where);
		$row = $this->tipo_login_model->getQuery();
		return $row;
	}
	
	public function getPermissao($permissao,$error = NULL,$redireciona = FALSE,$pagina = NULL){
		$usuario = $this->get_permissoes();
		if($usuario!=NULL&&$usuario->{$permissao}){
			return TRUE;
		}else{
			if($redireciona){
				if($error==NULL) $error = 'error_permissao';
				$this->session->set_flashdata('alerta',$error);
				if($pagina==NULL) $pagina = 'home';
				redirect($pagina);
			}
			return FALSE;
		}
	}
        
        public function hasPermissao($idmenu,$para='consultar'){
            $campo = 'idmenu';
            if(!is_numeric($idmenu)){
                $campo = 'nome';
            }
            
            foreach($this->session->permissoes as $permissao){
                if($permissao[$campo]==$idmenu){
                    return $permissao[$para];
                }
            }
            return FALSE;
        }
        
        public function validarPermissaoDeAcesso($permissao,$alerta = 'error_permissao',$pagina = 'home'){
            if(!$this->hasPermissao($permissao)){
                $this->session->set_flashdata('alerta',$alerta);
                redirect($pagina);
            }
        }
}