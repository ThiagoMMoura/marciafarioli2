<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Carrosel extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		if(!$this->usuario_model->logado()) redirect('login/error_login_necessario');
		$data['perm'] = $this->usuario_model->get_permissoes();
		if(!$data['perm']->editarhome){
			$data = array('error'=>$this->lang->line('error_permissao_edicao'));
			$this->load->view('templates/alertas',$data);
		}
	}
	
	public function index(){
	}
	public function upload(){
		
		$config['upload_path']          = 'tmp_data/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 10000;
		$config['max_width']            = 2000;
		$config['max_height']           = 2000;
  
		$this->load->library('upload', $config);
  
		if ( ! $this->upload->do_upload())
		{
			$data = array('error'=>$this->upload->display_errors('',''));
			$this->load->view('templates/alertas',$data);
		}
		else
		{
			$data = $this->upload->data();

			echo img(array('src'=>base_url().$config['upload_path'].$data['file_name'],'id'=>'imgcrop'));
		}
		
	}
	public function crop(){
	}
}
?>