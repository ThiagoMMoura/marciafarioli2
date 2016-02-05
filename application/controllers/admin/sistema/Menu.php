<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Controle para busca e cadastro de Menus no Sistema
 *
 * @author Thiago Moura
 */
class Menu  extends MY_Controller{
    
    public function __construct(){
        $config['control_url'] = 'admin/sistema/menu';
        $config['login_required'] = TRUE;
        
        parent::__construct($config);
        
        $this->_set_campos_padrao();
    }
    
    public function index(){
        $this->busca();
    }
    
    public function busca($data = array()){
        
        if(!isset($data['menus'])){
            $data['menus'] = $this->menu_model->selecionar('*','sistema = 1','grupo ASC, ordem ASC');
        }
        
        $this->view('busca',$data);
    }
    
    public function cadastro($data = array()){
        $this->view('cadastro',$data);
    }
    
    public function editar($id = NULL){
        $data = array();
        if($id!==NULL){
            $data = $this->menu_model->get_array_by_id($id);
            $data['idmenu'] = $id;
            return $this->cadastro($data);
        }
        $this->index();
    }
    
    public function salvar(){
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|min_length[3]|max_length[100]');
        $this->form_validation->set_rules('descricao', 'Descricao', 'trim|max_length[300]');
        $this->form_validation->set_rules('url', 'URL', 'trim|min_length[3]|max_length[200]');
        $this->form_validation->set_rules('grupo', 'Grupo', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('tipo', 'Tipo', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('formato', 'Formato', 'trim|required|max_length[100]');
        
        if ($this->form_validation->run() == FALSE) {
            $this->cadastro();
        }else{
            $this->menu_model->setId($this->input->post('idmenu'));
            if($this->input->post('idmenupai')==NULL OR $this->input->post('idmenupai')==0){
                $this->menu_model->nivel = 1;
                $this->menu_model->idmenupai = '';
            }else{
                //Busca o menu pai e incrementa +1 no nivel dele
                $this->menu_model->nivel = (new Menu_model())->getObjectById($this->input->post('idmenupai'))->nivel + 1;
                $this->menu_model->idmenupai = $this->input->post('idmenupai');
            }
            $this->menu_model->ordem = $this->input->post('ordem')!=0?$this->input->post('ordem'):($this->menu_model->get_max_ordem(NULL,TRUE) + 1);
            $this->menu_model->nome = $this->input->post('nome');
            $this->menu_model->descricao = $this->input->post('descricao');
            $this->menu_model->url = $this->input->post('url');
            $this->menu_model->icone = $this->input->post('icone');
            $this->menu_model->grupo = $this->input->post('grupo');
            $this->menu_model->tipo = $this->input->post('tipo');
            $this->menu_model->formato = $this->input->post('formato');
            $this->menu_model->sistema = TRUE;
            if($this->menu_model->salvar(FALSE)){
                $this->session->set_flashdata('alerta', 'success_save');
                redirect('admin/sistema/menu/editar/'.$this->menu_model->getId());
            }
            $this->session->set_flashdata('alerta', 'error_save');
            $this->cadastro($this->menu_model->get_fields_array());
        }
    }
    
    private function _set_campos_padrao(){
        $default_page_fields = array(
            'cadastro' => array(
                'idmenu' => '',
                'nome' => '',
                'descricao' => '',
                'url' => '',
                'grupo' => '',
                'tipo' => '',
                'formato' => '',
                'icone' => '',
                'nivel' => '0',
                'ordem' => '0',
                'idmenupai' => '0',
                'sistema' => '1',
                'icones' => $this->_get_options_icone(),
                'urls' => $this->_get_options_url(),
                'grupos' => $this->_get_options_grupo(),
                'tipos' => $this->_get_options_tipo(),
                'formatos' => $this->_get_options_formato(),
                'menus' =>$this->menu_model->getOptionsArray('nome','sistema = 1','nome ASC')
                ),
            'busca' => array(
                'menus' => $this->menu_model->selecionar('*','sistema = 1','grupo ASC, ordem ASC')
                )
            );
            
        $this->_set_default_page_fields($default_page_fields);
    }
    
    public function ordenar(){
        $requisicao = $this->input->post('requisicao');
        if($requisicao === 'ajax'){
            $id = $this->input->post('id');
            $retorna = $this->input->post('retorna');
            $retorno = $this->menu_model->get_array_by_id($id);
            $retorno['itens'] = $this->menu_model->get_itens_menu($id);
            
            if($retorna==='json'){
                echo json_encode($retorno);
            }elseif($retorna==='html'){
                
            }elseif($retorna==='xml'){
                
            }else{
                echo print_r($retorno);
            }
        }
    }
    
    private function _get_options_grupo(){
        $grupos = array();
        foreach($this->menu_model->selecionar_distinto('grupo','sistema = 1','grupo ASC') as $menu){
            $grupos[$menu['grupo']] = $menu['grupo'];
        }
        return $grupos;
    }
    
    private function _get_options_tipo(){
        $tipos = array();
        foreach($this->menu_model->get_lista_tipos() as $tipo){
            $tipos[$tipo] = ucfirst($tipo);
        }
        return $tipos;
    }
    
    private function _get_options_formato(){
        $formatos = array();
        foreach($this->menu_model->get_lista_formatos() as $formato){
            $formatos[$formato] = ucfirst($formato);
        }
        return $formatos;
    }
    
    private function _get_options_url(){
        $urls = array();
        foreach($this->usuario_model->get_urls_restritas() as $url){
            $urls[$url] = $url;
        }
        return $urls;
    }
    
    private function _get_options_icone(){
        $icones = array();
        foreach($this->config->item('icones') as $key => $icone){
            $icones[$icone] = icone($key);
        }
        return $icones;
    }
}
