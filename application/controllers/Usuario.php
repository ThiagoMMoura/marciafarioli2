<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Usuario extends MY_Controller {
	
    public function __construct(){
        parent::__construct('usuario');
        $this->_set_top_bar_visible(FALSE);
    }

    public function index(){
        $this->view('login');
    }

//    public function view($page = 'login',$data = array()){
//        if ( ! file_exists(APPPATH.'/views/usuario/'.$page.'.php')){
//            // Whoops, we don't have a page for that!
//            show_404();
//        }
//        $data['title'] = ucfirst($page); // Capitalize the first letter
//        $data['page'] = $page;
//
//        $alerta = $this->session->flashdata('alerta');
//        if ($alerta !== NULL) {
//            $data[separa_str($alerta, '_', FALSE)] = $this->lang->line($alerta);
//        }
//
//        $this->load->view('templates/header', $data);
//        $this->load->view('usuario/'.$page,$data);
//        $this->load->view('templates/scripts',$data);
//    }

    public function entrar(){
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('senha', 'Senha', 'trim|required|md5');

        if ($this->form_validation->run() == FALSE) {
            $this->view('login');
        } else {
            if($this->usuario_model->is_valid_user()){
                $userdata = $this->usuario_model->get_first_row_array();
                $userdata['logado'] = TRUE;

                $this->session->set_userdata($userdata);
                redirect('home');
            }else{
                $this->session->set_flashdata('alerta', 'error_login_incorreto');
                $this->view('login');
            }
        }
    }

    public function sair(){
        $userdata = $this->usuario_model->get_list_fields();
        
        $this->session->set_userdata('logado', FALSE);
        $this->session->unset_userdata('logado');
        
        $this->session->unset_userdata($userdata);
        redirect('login');
    }

    public function cadastrar(){
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[60]|is_unique[usuario.email]',array('is_unique'=>'Este email já foi cadastrado, tente outro.'));
        $this->form_validation->set_rules('senha', 'Senha', 'trim|required|max_length[50]|md5');
        $this->form_validation->set_rules('confirmasenha', 'Confirmação de senha', 'trim|required|md5|matches[senha]');
        $this->form_validation->set_rules('sexo','Sexo','required',array('required'=>'Selecione uma opção.'));

        if ($this->form_validation->run() == FALSE) {
            $this->view('cadastro');
        }else{
            $this->usuario_model->nome = $this->input->post('nome');
            $this->usuario_model->email = $this->input->post('email');
            $this->usuario_model->senha = $this->input->post('senha');
            $this->usuario_model->sexo = $this->input->post('sexo');
            $this->usuario_model->idnivel = $this->config->item('nivelusuariopadrao');
            
            if($this->usuario_model->inserir(FALSE)){
                redirect('login');
            }else{
                $this->session->set_flashdata('alerta','error_register_failed_try_later');
                redirect('cadastrar');
            }
        }
    }

    public function cadastro(){
        $this->view('cadastro');
    }

    public function recuperarsenha(){
        $this->session->set_flashdata('alerta','warning_not_implemented');
        $this->view('login');
    }
}