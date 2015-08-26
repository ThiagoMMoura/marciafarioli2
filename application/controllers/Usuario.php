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
		
		if ($this->form_validation->run() == FALSE) {
			$this->view('login');
		} else {
			if($this->usuario_model->valida()){
				/*$this->session->set_userdata(get_object_vars($this->usuario_model));*/
				$userdata = array('id'=>$this->usuario_model->id,
								'nome'=>$this->usuario_model->nome,
								'email'=>$this->usuario_model->email,
								'idtipologin'=>$this->usuario_model->idtipologin,
								'idfotoperfil'=>$this->usuario_model->nome,
								'logado'=>TRUE
								);
				$this->session->set_userdata($userdata);
				redirect('home');
			}
		}
	}
	
	public function sair(){
		$userdata = array('id','nome','email','idtipologin','idfotoperfil','logado');
		$this->session->set_userdata('logado', FALSE);
		$this->session->unset_userdata($userdata);
		redirect('login');
	}
	
	public function cadastrar(){
		$this->form_validation->set_rules('nome', 'Nome', 'trim|required|min_length[3]|max_length[50]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[60]|is_unique[usuario.email]');
        $this->form_validation->set_rules('senha', 'Senha', 'trim|required|max_length[50]|md5');
		$this->form_validation->set_rules('confirmasenha', 'Confirmação de senha', 'trim|required|md5|matches[senha]');
        $this->form_validation->set_rules('sexo','Sexo','required');
		$this->form_validation->set_error_delimiters('<small class="error">', '</small>');
		if ($this->form_validation->run() == FALSE) {
			$this->view('cadastro');
		}else{
			$this->usuario_model->nome = $this->input->post('nome');
			$this->usuario_model->email = $this->input->post('email');
			$this->usuario_model->senha = $this->input->post('senha');
			$this->usuario_model->sexo = $this->input->post('sexo');
			$this->usuario_model->idtipologin = $this->config->item('tipousuariopadrao');
			$this->usuario_model->inserir(FALSE);
			redirect('login');
		}
	}
	
	public function cadastro(){
		$this->view('cadastro');
	}
}
?>