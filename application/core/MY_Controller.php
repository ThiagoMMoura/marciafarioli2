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
    /**
     * @var string 
     */
    protected $control_url = '';
    /**
     * @var array 
     */
    private $default_page_fields = array();
    /**
     * @var array 
     */
    private $_default_page_data = array();
    /**
     * @var array 
     */
    private $_page_data = array();
    /**
     * @var array 
     */
    private $_default_page_head_elements = array(
        'links' => array(
            NORMALIZE_CSS_FILE_LOCAL,
            RESPONSIVE_FW_CSS_FILE_LOCAL,
            FONTES_PATH . '/foundation-icons/foundation-icons.css',
            APP_CSS_FILE_LOCAL,
            CSS_PATH .'/barra-ferramentas.css'
        ),
        'scripts' => array(
            MODERNIZR_JS_FILE_LOCAL,
            JQUERY_JS_FILE_LOCAL
        )
    );
    /**
     * @var array 
     */
    private $_page_head_elements = array();
    /**
     * @var array 
     */
    private $_default_page_foot_elements = array();
    /**
     * @var array 
     */
    private $_page_foot_elements = array();
    /**
     * @var boolean 
     */
    private $top_bar_visible = TRUE;
    /**
     * @var string 
     */
    private $redirect_page = 'alertas';
    /**
     * @var string 
     */
    private $redirect_alert = 'error_permissao';
    /**
     * @var boolean 
     */
    private $login_required = FALSE;

    /**
     * Contrutor da classe.
     * 
     * @param mixed $config <b>URL</b> do controle, ou array de configurações.
     */
    public function __construct($config = '') {
        parent::__construct();
        
        if(!is_array($config)){
            $config = array('control_url' => $config);
        }
        
        empty($config) OR $this->_initialize($config, FALSE);
        
        if($this->login_required && !$this->_logged()){
            $this->session->set_flashdata('alerta', 'error_login_required');
            redirect('login');
        }
        
        $url = ($this->_get_function_name()!=NULL ? $this->control_url . '/' . $this->_get_function_name() : $this->control_url);
        if(!$this->_has_access_permission($url)){
            $this->session->set_flashdata('alerta', $this->redirect_alert);
            redirect($this->redirect_page);
        }
    }
    
    /**
     * 
     * @param array $config
     * @param boolean $reset
     */
    protected function _initialize(array $config = [], $reset = TRUE){
        $reflection = new ReflectionClass('MY_Controller');

        if ($reset === TRUE)
        {
            $defaults = $reflection->getDefaultProperties();
            foreach (array_keys($defaults) as $key)
            {
                if ($key[0] === '_')
                {
                    continue;
                }

                if (isset($config[$key]))
                {
                    if ($reflection->hasMethod('set_'.$key))
                    {
                        $this->{'set_'.$key}($config[$key]);
                    }
                    elseif ($reflection->hasMethod('_set_'.$key))
                    {
                        $this->{'_set_'.$key}($config[$key]);
                    }
                    else
                    {
                        $this->$key = $config[$key];
                    }
                }
                else
                {
                    $this->$key = $defaults[$key];
                }
            }
        }
        else
        {
            foreach ($config as $key => &$value)
            {
                if ($key[0] !== '_' && $reflection->hasProperty($key))
                {
                    if ($reflection->hasMethod('set_'.$key))
                    {
                        $this->{'set_'.$key}($value);
                    }
                    elseif ($reflection->hasMethod('_set_'.$key))
                    {
                        $this->{'_set_'.$key}($config[$key]);
                    }
                    else
                    {
                        $this->$key = $value;
                    }
                }
            }
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
        if(!isset($data['urls_restritas'])){$data['urls_restritas'] = $this->usuario_model->get_urls_restritas($this->session->idnivel);}
        $data['page_head_elements'] = $this->_get_page_head_elements($page, $data);

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
            if($this->redirect_page!=NULL){
                redirect($this->redirect_page);
            }else{
                $this->_alertas($page,$data);
                return;
            }
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
     * Retorna um array com os campos padrões na página solicitada.
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
    
    private function _get_page_head_elements($page,$data){
        $page_head_elements = $this->_default_page_head_elements;
        if(isset($this->_page_head_elements[$page])){
            foreach($this->_page_head_elements[$page] as $key => $value){
                if(isset($page_head_elements[$key])){
                    $page_head_elements[$key] = array_merge($page_head_elements[$key],$value);
                }else{
                    $page_head_elements[$key] = $value;
                }
                if(isset($data['page_head_elements'][$key])){
                    $page_head_elements[$key] = array_merge($page_head_elements[$key],$data['page_head_elements'][$key]);
                }
            }
        }else{
            if(isset($data['page_head_elements'])){
                foreach($data['page_head_elements'] as $key => $value){
                    if(isset($page_head_elements[$key])){
                        $page_head_elements[$key] = array_merge($page_head_elements[$key],$value);
                    }else{
                        $page_head_elements[$key] = $value;
                    }
                }
            }
        }
        return $page_head_elements;
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
     * Seta propriedade $_page_head_elements
     * 
     * @param type $page_head_elements
     */
    protected function _set_page_head_elements($page_head_elements){
        $this->_page_head_elements = $page_head_elements;
    }
    
    /**
     * Seta propriedade $_page_foot_elements
     * 
     * @param type $page_foot_elements
     */
    protected function _set_page_foot_elements($page_foot_elements){
        $this->_page_foot_elements = $page_foot_elements;
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
    protected function _set_control_url($url = ''){
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
    
    /**
     * Retorna uma página de alertas.
     * 
     * @param array $data
     */
    protected function _alertas($page = 'alerta',$data = array()){
        
        $data = $this->_pre_data_view($page, $data);
        
        $this->load->view('templates/header', $data);
	if($this->top_bar_visible){
            $this->load->view('templates/top_bar_menu', $data);
        }
        $this->load->view('templates/alertas', $data);
        $this->load->view('templates/scripts',$data);
    }
}
