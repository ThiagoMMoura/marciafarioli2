<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Editar extends CI_Controller {
	public function inde(){
	}
	public function view($page)
	{
		if ( ! file_exists(APPPATH.'/views/admin/editar/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }
		
		$data['title'] = 'Editar '.ucfirst($page); // Capitalize the first letter
		$data['page'] = 'editar/'.$page;
		if($this->usuario_model->logado()){
			$data['perm'] = $this->usuario_model->get_permissoes();
		}else{
			redirect('login/error_login_necessario');
		}
		
		$this->load->view('templates/header',$data);
		$this->load->view('templates/top_bar_menu', $data);
        $this->load->view('admin/editar/'.$page, $data);
        $this->load->view('templates/scripts',$data);
	}
}
?>