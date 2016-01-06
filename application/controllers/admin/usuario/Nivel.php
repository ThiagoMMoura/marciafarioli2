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
            $this->nivel_model->selecionar('*','id =' . $id);
            $query = $this->nivel_model->getQuery();
            $data = $query->row_array();
            $data['idnivel'] = $id;
            $data['permissoes'] = $this->permissao_model->selecionar('*','idnivel = ' . $id,'nome ASC');
            return $this->view('cadastro',$data);
        }
        $this->index();
    }
    
    public function salvar(){
        $is_unique = $this->input->post('id')==NULL?"|is_unique[nivel.nome]":'';
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|min_length[3]|max_length[100]'.$is_unique,array('is_unique'=>'Este nome já foi cadastrado, tente outro.'));
        $this->form_validation->set_rules('email', 'Email', 'trim|max_length[300]');
        
        if ($this->form_validation->run() == FALSE) {
            $this->view('cadastro');
        }else{
            $this->nivel_model->setId($this->input->post('idnivel'));
            $this->nivel_model->nome = $this->input->post('nome');
            $this->nivel_model->descricao = $this->input->post('descricao');
            if($this->nivel_model->salvar(FALSE)){
                $i = 0;
                foreach($this->input->post('idmenu') as $id){
                    $this->permissao_model->setId($this->input->post('idpermissao['.$i.']'));
                    $this->permissao_model->idnivel = $this->nivel_model->getId();
                    $this->permissao_model->idmenu = $id;
                    $this->permissao_model->nome = $this->input->post('nome_permissao['.$i.']');
                    $this->permissao_model->consultar = $this->input->post('consultar['.$i.']');
                    $this->permissao_model->incluir = $this->input->post('incluir['.$i.']');
                    $this->permissao_model->editar = $this->input->post('editar['.$i.']');
                    $this->permissao_model->excluir = $this->input->post('excluir['.$i.']');
                    if($this->permissao_model->nome!==NULL){
                        $this->permissao_model->salvar(FALSE);
                    }
                    $i++;
                }
                $this->view('busca');
            }else{
                $this->view('cadastro');
            }
        }
    }
}
