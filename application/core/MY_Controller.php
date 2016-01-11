<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Extensão de CI_Controller
 *
 * @author Thiago Moura
 */
class MY_Controller extends CI_Controller{
    private $views_path;

    public function __construct($views_path = '',$permissao = FALSE,$alerta = '',$pagina = '') {
        parent::__construct();
        
        $this->views_path = $views_path;
        
        if($permissao && $this->usuario_model->verificaUsuario()){
            if($alerta == NULL){
                $alerta = 'error_permissao';
            }if($pagina == NULL){
                $pagina = 'home';
            }
            $permissao = substr(str_replace('/', '-', $views_path),0,-1);
            $this->usuario_model->validarPermissaoDeAcesso($permissao,$alerta,$pagina);
        }
    }
    
    /**
     * Função que verfica se a view existe e retorna erro 404 caso não exista.
     * 
     * @param string $page
     */
    private function _view_exists($page){
        if ( ! file_exists(APPPATH.'/views/'.$this->views_path.$page.'.php')){
            // Whoops, we don't have a page for that!
            show_404();
        }
    }
    
    /**
     * Carrega algumas informações essenciais para todas as páginas do sistema.
     * E retorna em um array.
     * 
     * @param string $page
     * @param array $data
     * @return array $data
     */
    private function _pre_data_view($page,$data){
        $data['title'] = ucfirst($page); // Capitalize the first letter
        $data['page'] = $page;
        
        $alerta = $this->session->flashdata('alerta');
        if ($alerta !== NULL) {
            $data[separa_str($alerta, '_', FALSE)] = $this->lang->line($alerta);
        }
        
        return $data;
    }

    /**
     * Função de carregamento de view para o browser.
     * 
     * @param string $page
     * @param array $data
     */
    public function view($page,$data = array()){
	
        $this->_view_exists($page);
        
        $data = $this->_pre_data_view($page, $data);
        
        $this->load->view('templates/header', $data);
	$this->load->view('templates/top_bar_menu', $data);
        $this->load->view($this->views_path.$page, $data);
        $this->load->view('templates/scripts',$data);
    }

}
