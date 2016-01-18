<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Editar extends CI_Controller {
	
	public function index(){
		show_404();
	}
	
	public function view($page,$alerta=NULL,$data=array())
	{
		if ( ! file_exists(APPPATH.'/views/admin/editar/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }
		
		$data['title'] = 'Editar '.ucfirst($page); // Capitalize the first letter
		$data['page'] = 'editar/'.$page;
//		if($this->usuario_model->verificaUsuario()){
//			$data['perm'] = $this->usuario_model->get_permissoes();
//		}
		if($this->session->flashdata('data')!==NULL){
			foreach($this->session->flashdata('data') as $campo => $value){
				$data[$campo] = $value;
			}
		}
		
		$alerta = $this->session->flashdata('alerta');
		if($alerta!==NULL)$data[separa_str($alerta,'_',FALSE)]=$this->lang->line($alerta);
		
		$this->load->view('templates/header',$data);
		$this->load->view('templates/top_bar_menu', $data);
        $this->load->view('admin/editar/'.$page, $data);
        $this->load->view('templates/scripts',$data);
	}
}
?>