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
    protected $control_url;
    private $default_page_fields;

    /**
     * 
     * @param string $control_url
     * @param bool $permissao
     * @param string $alerta
     * @param string $pagina
     */
    public function __construct($control_url = '',$permissao = FALSE,$alerta = '',$pagina = '') {
        parent::__construct();
        
        $this->_set_control_url($control_url);
        
        if($permissao && $this->usuario_model->verificaUsuario()){
            if($alerta == NULL){
                $alerta = 'error_permissao';
            }if($pagina == NULL){
                $pagina = 'home';
            }
            $permissao = str_replace('/', '-', $this->control_url);
            $this->usuario_model->validarPermissaoDeAcesso($permissao,$alerta,$pagina);
        }
    }
    
    /**
     * Função que verfica se a view existe e retorna erro 404 caso não exista.
     * 
     * @param string $page
     */
    private function _view_exists($page){
        if ( ! file_exists(APPPATH.'/views/'.$this->control_url.'/'.$page.'.php')){
            // Whoops, we don't have a page for that!
            echo $page;
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
        $data = $this->_get_default_fields('default', $data);
        if(!isset($data['title'])){$data['title'] = ucfirst($page);} // Capitalize the first letter
        if(!isset($data['page'])){$data['page'] = $page;}
        
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
        $data = $this->_get_default_fields($page,$data);
        $data = $this->_pre_data_view($page, $data);
        
        $this->load->view('templates/header', $data);
	$this->load->view('templates/top_bar_menu', $data);
        $this->load->view($this->control_url.'/'.$page, $data);
        $this->load->view('templates/scripts',$data);
    }
    
    private function _get_default_fields($page,$data){
        if(isset($this->default_page_fields[$page])){
            foreach($this->default_page_fields[$page] as $field => $value){
                if(!isset($data[$field])){
                    $data[$field] = $value;
                }
            }
        }
        return $data;
    }
    
    protected function _set_default_page_fields($page_fields){
        $this->default_page_fields = $page_fields;
    }
    
    protected function _get_function_name(){
        $remove_url_control = substr(uri_string(), strlen($this->control_url)+1);
        $method_name = stristr($remove_url_control, '/',TRUE);
        if($method_name===FALSE){
            $method_name = stristr($remove_url_control, '.',TRUE);
            if($method_name===FALSE){
                $method_name = $remove_url_control;
            }
        }
        if(method_exists(get_class($this), $method_name)){
            return $method_name;
        }else{
            return get_class($this). '->' . $method_name . '.' . $remove_url_control;
        }
    }
    
    private function _set_control_url($url = ''){
        if(substr($url,-1)=='/'){
            $url = substr($url,0,-1);
        }
        $this->control_url = $url;
    }

}
