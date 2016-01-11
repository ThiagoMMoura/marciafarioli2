<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Controle para criação, edição e exclusão de itens de configuração do sistema.
 *
 * @author Thiago Moura
 */
class Configure extends MY_Controller{
    public function __construct(){
        parent::__construct('admin/sistema/configure/',TRUE);
    }
    
    public function index(){
        $this->busca();
    }
    
    public function busca($data = array()){
        $this->view('busca',$data);
    }
}
