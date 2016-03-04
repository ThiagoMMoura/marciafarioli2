<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pages extends MY_Controller {

    public function __construct(){
        parent::__construct('pages');
        $this->_set_campos_padrao();
    }
    
    public function index(){
        $this->view('home');
    }
    
    public function alertas($data = array()){
        $this->_alertas('alerta',$data);
    }

    private function _set_campos_padrao() {
        $page_head_elements = array(
            'home' => array(
                'links' => array(
                    SLICK_CSS_FILE_LOCAL,
                    SLICK_THEME_CSS_FILE_LOCAL,
                    CSS_PATH . '/home.css'
                )
            )
        );
        $this->_set_page_head_elements($page_head_elements);
    }

//    public function view($page = 'home'){
//        if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php')){
//            // Whoops, we don't have a page for that!
//            show_404();
//        }
//
//        $data['title'] = ucfirst($page); // Capitalize the first letter
//        $data['page'] = $page;
//        if($this->usuario_model->isLogado()){
//            $data['perm'] = $this->usuario_model->get_permissoes();
//        }
//        $this->load->view('templates/header', $data);
//        $this->load->view('templates/top_bar_menu', $data);
//        $this->load->view('pages/'.$page, $data);
//        $this->load->view('templates/scripts',$data);
//    }
}