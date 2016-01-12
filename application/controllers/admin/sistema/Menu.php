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
        
        $data['menus'] = $this->menu_model->selecionar('*','sistema = 1','grupo ASC, ordem ASC');
        
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
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|min_length[3]|max_length[100]');
        $this->form_validation->set_rules('descricao', 'Descricao', 'trim|max_length[300]');
        $this->form_validation->set_rules('url', 'URL', 'trim|required|min_length[3]|max_length[200]');
        $this->form_validation->set_rules('grupo', 'Grupo', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('tipo', 'Tipo', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('formato', 'Formato', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('permissao', 'Permissao', 'trim|required|max_length[100]');
        
        if ($this->form_validation->run() == FALSE) {
            $this->cadastro();
        }else{
            
        }
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
                if(!isset($data['sistema'])){$data['sistema'] = '1';}
                if(!isset($data['grupos'])){$data['grupos'] = $this->_get_options_grupo();}
                if(!isset($data['tipos'])){$data['tipos'] = $this->_get_options_tipo();}
                if(!isset($data['formatos'])){$data['formatos'] = $this->_get_options_formato();}
                if(!isset($data['permissoes'])){$data['permissoes'] = $this->_get_options_permissao();}
            }
        }
        return $data;
    }
    
    private function _get_options_grupo(){
        $grupos = array();
        foreach($this->menu_model->selecionar_distinto('grupo','sistema = 1','grupo ASC') as $menu){
            $grupos[$menu['grupo']] = $menu['grupo'];
        }
        return $grupos;
    }
    
    private function _get_options_tipo(){
        $tipos = array();
        foreach($this->menu_model->get_lista_tipos() as $tipo){
            $tipos[$tipo] = ucfirst($tipo);
        }
        return $tipos;
    }
    
    private function _get_options_formato(){
        $formatos = array();
        foreach($this->menu_model->get_lista_formatos() as $formato){
            $formatos[$formato] = ucfirst($formato);
        }
        return $formatos;
    }
    
    private function _get_options_permissao(){
        $permissoes = array();
        foreach($this->menu_model->get_lista_permissoes() as $permissao){
            $permissoes[$permissao] = ucfirst($permissao);
        }
        return $permissoes;
    }
}
