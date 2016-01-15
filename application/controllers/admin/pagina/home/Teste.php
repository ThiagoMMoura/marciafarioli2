<?php

/**
 * Classe Controle para testes.
 *
 * @author 61171
 */
class Teste extends MY_Controller{
    public function __construct(){
        parent::__construct('admin/pagina/home/teste');
        $this->_set_campos_padrao();
    }
    
    public function index(){
        echo '<br />URL solicitada: ' . uri_string();
        echo '<br />URL gerada: '. ($this->_get_function_name()!=''?$this->control_url.'/' . $this->_get_function_name() : $this->control_url);
        $this->view('buscar');
    }
    
    public function editar($id = NULL){
        echo '<br />URL solicitada: ' . uri_string();
        echo '<br />URL gerada: '. ($this->_get_function_name()!=''?$this->control_url.'/' . $this->_get_function_name() : $this->control_url);
    }
    
    public function salvar(){
        echo '<br />URL solicitada: ' . uri_string();
        echo '<br />URL gerada: '. ($this->_get_function_name()!=''?$this->control_url.'/' . $this->_get_function_name() : $this->control_url);
    }
    
    private function _set_campos_padrao(){
        $default_page_fields = array(
            'buscar' => array(
                'url_solicitada' => uri_string(),
                'url_gerada' => $this->_get_function_name()!=''?$this->control_url.'/' . $this->_get_function_name() : $this->control_url
            ),
            'default' => array(
                'nome' => $this->_get_function_name()
            )
        );
        $this->_set_default_page_fields($default_page_fields);
    }
}
