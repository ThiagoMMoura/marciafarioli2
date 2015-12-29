<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pages extends CI_Controller {

	public function index(){
            $this->view('home');
	}
	
	public function view($page = 'home'){
            if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php')){
                // Whoops, we don't have a page for that!
                show_404();
            }

            $data['title'] = ucfirst($page); // Capitalize the first letter
            $data['page'] = $page;
            if($this->usuario_model->isLogado()){
                $data['perm'] = $this->usuario_model->get_permissoes();
            }
            $this->load->view('templates/header', $data);
            $this->load->view('templates/top_bar_menu', $data);
            $this->load->view('pages/'.$page, $data);
            $this->load->view('templates/scripts',$data);
	}
}