<?php

/**
 * Description of Url
 *
 * @author Thiago Moura
 */
class Url extends MY_Controller{
    
    public function __construct(){
        $config['control_url'] = 'admin/sistema/url';
        $config['login_required'] = TRUE;
        
        parent::__construct($config);
        
        $this->_set_campos_padrao();
    }
    
    public function index(){
        $this->busca();
    }

    public function busca($data = array()){
        $this->view('busca',$data);
    }
    
    public function cadastro($data = array()){
        $this->view('cadastro',$data);
    }
    
    public function editar($id = NULL){
        $data = array();
        if($id!==NULL){
            $data = $this->url_model->get_array_by_id($id);
            $data['id'] = $id;
            return $this->cadastro($data);
        }
        $this->index();
    }
    
    public function salvar(){
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|min_length[3]|max_length[100]');
        $this->form_validation->set_rules('descricao', 'Descricao', 'trim|max_length[300]');
        $this->form_validation->set_rules('url', 'URL', 'trim|required|min_length[3]|max_length[200]');
        
        if ($this->form_validation->run() == FALSE) {
            $this->cadastro();
        }else{
            $this->url_model->setId($this->input->post('id'));
            $this->url_model->nome = $this->input->post('nome');
            $this->url_model->descricao = $this->input->post('descricao');
            $this->url_model->url = $this->input->post('url');
            $this->url_model->restricao = $this->input->post('restricao')==='restrito';
            
            if($this->url_model->salvar()){
                $this->session->set_flashdata('alerta', 'success_save');
                redirect('admin/sistema/url/busca');
            }
            $this->session->set_flashdata('alerta', 'error_save');
            $this->cadastro($this->url_model->get_fields_array());
        }
    }
    
    public function _set_campos_padrao() {
        $default_page_fields = array(
            'cadastro' => array(
                'id' => '',
                'nome' => '',
                'descricao' => '',
                'url' => '',
                'restricao' => FALSE
            ),
            'busca' => array(
                'urls' => $this->url_model->selecionar('*', NULL, 'nome ASC')
            )
        );
        $this->_set_default_page_fields($default_page_fields);
    }

}
