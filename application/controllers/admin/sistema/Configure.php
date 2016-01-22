<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Controle para criação, edição e exclusão de itens de configuração do sistema.
 *
 * @author Thiago Moura
 */
class Configure extends MY_Controller{
    public function __construct(){
        $config['control_url'] = 'admin/sistema/configure/';
        $config['login_required'] = TRUE;
        
        parent::__construct($config);
    }
    
    public function index(){
        $this->busca();
    }
    
    public function busca($data = array()){
        $this->view('busca',$data);
    }
}
