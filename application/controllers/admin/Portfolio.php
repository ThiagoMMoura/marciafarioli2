<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Portfolio extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		
		if($this->usuario_model->verificaUsuario()){
			$this->usuario_model->getPermissao('editarportfolio','error_permissao_edicao',TRUE);
		}
	}
	
	public function index(){
		show_404();
	}
	
	private function view($page,$alerta=NULL,$data=array()){
		if ( ! file_exists(APPPATH.'/views/admin/editar/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }
		
		$data['title'] = 'Editar '.ucfirst($page); // Capitalize the first letter
		$data['page'] = 'editar/'.$page;
		$data['perm'] = $this->usuario_model->get_permissoes();
		
		$alerta = $this->session->flashdata('alerta');
		if($alerta!==NULL)$data[separa_str($alerta,'_',FALSE)]=$this->lang->line($alerta);
		
		$this->load->view('templates/header',$data);
		$this->load->view('templates/top_bar_menu', $data);
        $this->load->view('admin/editar/'.$page, $data);
        $this->load->view('templates/scripts',$data);
	}
	
	public function upload(){
		if($this->input->post('url_album')!=NULL)$pasta = $this->input->post('url_album');
		else{
			$this->load->model('album_model');
			$query = $this->album_model->selecionar('url','id = '.$this->input->post('idalbum'));
			if ($query->num_rows() > 0){
				$row = $query->row();
				$pasta = $row->url;
			}else {
				$this->session->set_flashdata('alerta','error_album_inexistente');
				redirect('admin/editar/portfolio');
			}
		}
		$pastas = explode('/',$pasta);
		$redir = '';
		foreach($pastas as $dir){
			$redir = $redir.$dir.'/';
			if(!is_dir($redir)) mkdir($redir);
		}
		
		$nome = $this->input->post('file_name');
		
		$config['upload_path']          = $pasta;
		$config['file_name']            = $nome;
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 4096;
		$config['max_width']            = 4000;
		$config['max_height']           = 4000;
  
		$this->load->library('upload', $config);
  
		if ( ! $this->upload->do_upload()){
			$data = array('error'=>$this->upload->display_errors('',''));
			$this->load->view('templates/alertas',$data);
		}else{
			$data = $this->upload->data();
			$this->load->model('midia_model');
			
			$midia['nome'] = $data['file_name'];
			$midia['url'] = $data['full_path'];
			$midia['alt'] = $this->input->post('alt');
			$midia['local'] = TRUE;
			$midia['idalbum'] = $this->input->post('idalbum');
			$midia['idusuario'] = $this->session->id;
			
			if($this->midia_model->NovaImagemPortfolio($midia)) {
				$this->midia_model->getInserido();
				echo $this->midia_model->url;
			}else {
				$mensagem = array('error'=>$this->lang->line('error_insert_failed'));
				$this->load->view('templates/alertas',$mensagem);
			}
		}
	}
	
	public function criar_album(){
		
		$this->form_validation->set_rules('nome_album', 'Nome', 'trim|required|min_length[3]|max_length[100]');
		
		if ($this->form_validation->run() == FALSE) {
			$this->view('album');
		}else{
			$this->load->model('album_model');
			
			$album['nome'] = $this->input->post('nome_album');
			$album['descricao'] = $this->input->post('descricao_album');
			$album['idusuario'] = $this->session->id;
			$album['idcapa'] = 0;
			
			if($this->album_model->NovoImagemPortfolio($album)) {
				$this->session->set_flashdata('data',array('idalbum'=>$this->db->insert_id()));
				redirect('admin/editar/portfolio');
			}else{
				$this->session->set_flashdata('alerta', 'error_insert_failed');
				redirect('admin/editar/album');
			}
		}
	}
}
?>