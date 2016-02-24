<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Conta
 *
 * @author Thiago Moura
 */
class Conta extends MY_Controller{
    public function __construct(){
        $config['control_url'] = 'admin/usuario/conta';
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

    private function _set_campos_padrao(){
        $default_page_fields = array(
            'cadastro' => array(
                'idusuario' => '',
                'nome' => ''
            ),
            'busca' => array(
                'usuarios' => $this->usuario_model->selecionar('*', NULL, 'nome ASC')
            )
        );
        $this->_set_default_page_fields($default_page_fields);
    }
}
