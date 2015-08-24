<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Usuario extends CI_Controller {
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
		$this->load->helper('form');
        $data['title'] = ucfirst($page); // Capitalize the first letter
		$data['page'] = $page;

        $this->load->view('templates/header', $data);
        $this->load->view('usuario/'.$page,$data);
        $this->load->view('templates/scripts');
	}
	public function login(){
		
	}
	public function logout(){
		
	}
	public function cadastro(){
		
	}
}
?>