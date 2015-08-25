<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Usuario extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
	}
	
	public function index(){
		$this->view();
	}
	
	public function view($page = 'login')
	{
		if ( ! file_exists(APPPATH.'/views/usuario/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }
        $data['title'] = ucfirst($page); // Capitalize the first letter
		$data['page'] = $page;

        $this->load->view('templates/header', $data);
        $this->load->view('usuario/'.$page,$data);
        $this->load->view('templates/scripts');
	}
	
	public function entrar(){
		
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('senha', 'Senha', 'trim|required|md5');
        $this->form_validation->set_error_delimiters('<small class="error">', '</small>');
		
		if($this->input->post('email')&&$this->input->post('senha')){
			if ($this->form_validation->run() == FALSE) {
				$this->view('login');
			} else {
				$query = $this->usuario_model->valida();
				if($query){
					$this->session->set_userdata($this->usuario_model);
					$this->session->set_userdata('logado', TRUE);
					redirect('home');
				}
			}
		}else $this->view('login');
		
	}
	
	public function sair(){
		
	}
	
	public function cadastrar(){
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[usuario.email]');
        $this->form_validation->set_rules('senha', 'Senha', 'trim|required|md5');
		$this->form_validation->set_rules('confirmasenha', 'Confirmação de senha', 'trim|required|md5|matches[senha]');
        $this->form_validation->set_error_delimiters('<small class="error">', '</small>');
		if ($this->form_validation->run() == FALSE) {
			$this->view('cadastro');
		}else{
			$this->usuario_model->inserir();
		}
	}
	
	public function cadastro(){
		$this->view('cadastro');
	}
}
?>