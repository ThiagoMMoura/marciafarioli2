<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {

	public function index()
	{
		
	}
	public function editar($page){
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
			$_POST['erro'] = 'Você precisa logar para acessar está área.';
			redirect('login');
		}
		
	}
}
?>