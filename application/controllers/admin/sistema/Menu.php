<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Controle para busca e cadastro de Menus no Sistema
 *
 * @author Thiago Moura
 */
class Menu  extends CI_Controller{
    
    public function __construct(){
        parent::__construct();

        if($this->usuario_model->verificaUsuario()){
            $this->usuario_model->validarPermissaoDeAcesso('admin-sistema-menu');
        }
    }
    
    public function index(){
        $this->view('busca');
    }
    
    public function view($page = 'busca',$data = array()){
	if ( ! file_exists(APPPATH.'/views/admin/sistema/menu/'.$page.'.php')){
            // Whoops, we don't have a page for that!
            show_404();
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter
        $data['page'] = $page;
        
        $alerta = $this->session->flashdata('alerta');
        if ($alerta !== NULL) {
            $data[separa_str($alerta, '_', FALSE)] = $this->lang->line($alerta);
        }
        
        $data = $this->_variaveis_padrao($page, $data);
        $this->load->view('templates/header', $data);
	$this->load->view('templates/top_bar_menu', $data);
        $this->load->view('admin/sistema/menu/'.$page, $data);
        $this->load->view('templates/scripts',$data);
    }
    
    public function busca($data = array()){
        
        $data['menus'] = $this->menu_model->selecionar('*',NULL,'grupo ASC, ordem ASC');
        
        $this->view('busca',$data);
    }
    
    public function cadastro($data = array()){
        $this->view('cadastro',$data);
    }
    
    public function editar($id = NULL){
        $data = array();
        if($id!==NULL){
            $this->menu_model->selecionar('*','id =' . $id);
            $query = $this->menu_model->getQuery();
            $data = $query->row_array();
            $data['idmenu'] = $id;
            return $this->cadastro($data);
        }
        $this->index();
    }
    
    public function salvar(){
        
    }
    
    private function _variaveis_padrao($page,$data){
        switch ($page){
            case 'cadastro':{
                if(!isset($data['idmenu'])){$data['idmenu'] = '';}
                if(!isset($data['nome'])){$data['nome'] = '';}
                if(!isset($data['descricao'])){$data['descricao'] = '';}
                if(!isset($data['url'])){$data['url'] = '';}
                if(!isset($data['grupo'])){$data['grupo'] = '';}
                if(!isset($data['tipo'])){$data['tipo'] = '';}
                if(!isset($data['formato'])){$data['formato'] = '';}
                if(!isset($data['permissao'])){$data['permissao'] = '';}
                if(!isset($data['icone'])){$data['icone'] = '';}
                if(!isset($data['nivel'])){$data['nivel'] = '';}
                if(!isset($data['ordem'])){$data['ordem'] = '';}
                if(!isset($data['idmenu'])){$data['idmenu'] = '';}
                if(!isset($data['idmenupai'])){$data['idmenupai'] = '';}
                if(!isset($data['sistema'])){$data['sistema'] = '0';}
                if(!isset($data['grupos'])){$data['grupos'] = $this->_get_options_grupo();}
            }
        }
        return $data;
    }
    
    private function _get_options_grupo(){
        $grupos = array();
        foreach($this->menu_model->selecionar_distinto('grupo',NULL,'grupo ASC') as $menu){
            $grupos[$menu['grupo']] = $menu['grupo'];
        }
        return $grupos;
    }
}
