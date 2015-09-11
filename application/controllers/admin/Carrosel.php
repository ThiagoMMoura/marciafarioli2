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
		$this->load->library('image_lib');
	}
	
	public function index(){
	}
	public function upload(){
		$pasta = 'tmp_data/';
		if(!is_dir($pasta)) mkdir($pasta);
		
		$config['upload_path']          = $pasta;
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 2048;
		$config['max_width']            = 4000;
		$config['max_height']           = 4000;
  
		$this->load->library('upload', $config);
  
		if ( ! $this->upload->do_upload()){
			$data = array('error'=>$this->upload->display_errors('',''));
			$this->load->view('templates/alertas',$data);
		}else{
			$data = $this->upload->data();
			
			/*$img_cfg['image_library'] = 'gd2';
			$img_cfg['source_image'] = $config['upload_path'].$data['file_name'];
			$img_cfg['maintain_ratio'] = TRUE;
			$img_cfg['width']         = 1000;
			
			$this->image_lib->initialize($img_cfg);
			
			if ( ! $this->image_lib->resize()){
				echo $this->image_lib->display_errors();
			}else{*/
				echo img(array('src'=>base_url().$config['upload_path'].$data['file_name'],'id'=>'imgcrop'));
			//}
		}
		
	}
	public function crop(){
		$data = $this->input->post();
		
		$nome = random_string('alnum', 16).strrchr($data['url'],'.');
		$pasta = 'images/site/carrosel/';
		if(!is_dir($pasta)) mkdir($pasta);
		
		$img_cfg['image_library'] = 'gd2';
		$img_cfg['source_image'] = str_replace(base_url(),'',$data['url']);
		$img_cfg['new_image'] = $pasta.$nome;
		$img_cfg['maintain_ratio'] = FALSE;
		$img_cfg['width'] = $data['w'];
		$img_cfg['height'] = $data['h'];
		$img_cfg['x_axis'] = $data['x'];
		$img_cfg['y_axis'] = $data['y'];
		
		
		$this->image_lib->initialize($img_cfg);
		
		if ( ! $this->image_lib->crop()){
			echo $this->image_lib->display_errors();
		}else{
			unlink($img_cfg['source_image']);
			redirect('admin/editar/carrosel');
		}
	}
}
?>