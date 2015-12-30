<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Nivel
 *
 * @author Thiago Moura
 */
class Nivel extends CI_Controller{
    
    public function __construct(){
        parent::__construct();

        if($this->usuario_model->verificaUsuario()){
            $this->usuario_model->validarPermissaoDeAcesso('admin-usuario-nivel');
        }
    }
    
    public function index(){
        $this->view('busca');
    }
    
    public function view($page = 'busca',$data = array()){
	if ( ! file_exists(APPPATH.'/views/admin/usuario/nivel/'.$page.'.php')){
            // Whoops, we don't have a page for that!
            show_404();
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter
        $data['page'] = $page;
        
        $alerta = $this->session->flashdata('alerta');
        if ($alerta !== NULL) {
            $data[separa_str($alerta, '_', FALSE)] = $this->lang->line($alerta);
        }
        
        $this->load->view('templates/header', $data);
	$this->load->view('templates/top_bar_menu', $data);
        $this->load->view('admin/usuario/nivel/'.$page, $data);
        $this->load->view('templates/scripts',$data);
    }
    
    public function editar($id = NULL){
        $data = array();
        if($id!==NULL){
            $data = $this->nivel_model->selecionar('*','id =' . $id);
            $data['idnivel'] = $id;
            $data['permissoes'] = $this->permissao_model->selecionar('*','idnivel = ' . $id,'nome ASC');
            return $this->view('cadastro',$data);
        }
        $this->index();
    }
    
    public function salvar(){
        
    }
}
