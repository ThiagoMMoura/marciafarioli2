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
    private $top_bar_visible;
    private $redirect_page;
    private $redirect_alert;

    /**
     * Contrutor da classe.
     * 
     * @param string $control_url <b>URL</b> do controle.
     * @param string $alerta <b>Id</b> do alerta em caso de falta de permissão.
     * @param string $pagina Página de redirecionamento automático em caso de falta
     * de permissão.
     */
    public function __construct($control_url = '',$alerta = '',$pagina = '') {
        parent::__construct();
        
        $this->_set_control_url($control_url);
        
        $this->top_bar_visible = TRUE;
        
        if($alerta == NULL){
            $this->redirect_alert = 'error_permissao';
        }else{
            $this->redirect_alert = $alerta;
        }
        
        if($pagina == NULL){
            $this->redirect_page = 'home';
        }else{
            $this->redirect_page = $pagina;
        }
        
        $url = ($this->_get_function_name()!=NULL ? $this->control_url . '/' . $this->_get_function_name() : $this->control_url);
        if(!$this->_has_access_permission($url)){
            $this->session->set_flashdata('alerta', $this->redirect_alert);
            redirect($this->redirect_page);
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
        if(!isset($data['logged'])){$data['logged'] = $this->_logged();}
        if(!isset($data['urls_restritas'])){$data['urls_restritas'] = $this->usuario_model->get_urls_restritas($this->session-idnivel);}
        
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
        
        if(!$this->_has_access_permission($this->control_url . '/' . $page)){
            $this->session->set_flashdata('alerta', $this->redirect_alert);
            redirect($this->redirect_page);
        }
        
        $data = $this->_get_default_fields($page,$data);
        $data = $this->_pre_data_view($page, $data);
        
        $this->load->view('templates/header', $data);
	if($this->top_bar_visible){
            $this->load->view('templates/top_bar_menu', $data);
        }
        $this->load->view($this->control_url.'/'.$page, $data);
        $this->load->view('templates/scripts',$data);
    }
    
    /**
     * Retorna um array com os campor padrões na página solicitada.
     * 
     * @param string $page
     * @param array $data
     * @return array
     */
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
    
    /**
     * Seta propriedade $default_page_fields
     * 
     * @param matriz $page_fields
     */
    protected function _set_default_page_fields($page_fields){
        $this->default_page_fields = $page_fields;
    }
    
    /**
     * Retorna o nome da função chamada por requisição HTTP.
     * 
     * @return string Se o método existir ele retorna o nome do método, senão, 
     * retorna uma <code>string</code> vazia.
     */
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
            return '';
        }
    }
    
    /**
     * Setar a propriedade <code>$control_url</code> que define a <b>URL</b> do controle.
     * 
     * @param string $url <b>URL</b> do controle.
     */
    private function _set_control_url($url = ''){
        if(substr($url,-1)=='/'){
            $url = substr($url,0,-1);
        }
        $this->control_url = $url;
    }
    
    /**
     * Retorna <b>TRUE</b> se o usuário tem permissão de acesso para está área, 
     * <b>FALSE</b> caso contrário.
     * 
     * @param string $url define a url que será validado o acesso.
     * @param bool $redirect_on_logoff Se <b>TRUE</b>, caso o usuário não esteja logado,
     * ele será redirecionado para a página de login.
     * @return boolean
     */
    protected function _has_access_permission($url = '',$redirect_on_logoff = TRUE){
        if($url == NULL){
            $url = $this->control_url;
        }
        
        if($this->url_model->has_restricao_for_url($url)){
            if($this->_logged()){
                return $this->permissao_model->has_permissao($this->session->idnivel, $this->url_model->getId());
            }else{
                if($redirect_on_logoff){
                    $this->session->set_flashdata('alerta', 'error_login_required');
                    redirect('login');
                }
                return FALSE;
            }
        }
        return TRUE;
    }
    
    /**
     * Retorna <b>TRUE</b> se o usuário estiver logado, <b>FALSE</b> caso contrário.
     * 
     * @return boolean
     */
    protected function _logged() {
        return ($this->session->has_userdata('logado') && $this->session->logado);
    }

    /**
     * Seta o valor da variável $top_bar_visible
     * 
     * @param boolean $visible
     */
    protected function _set_top_bar_visible($visible){
        $this->top_bar_visible = $visible;
    }
}
