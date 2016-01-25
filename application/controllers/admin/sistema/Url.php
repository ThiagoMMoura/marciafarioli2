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
