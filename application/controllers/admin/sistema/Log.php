<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Controle para exibição de logs do sistema
 *
 * @author Thiago Moura
 */
class Log {
    public function __construct(){
        parent::__construct();

        if($this->usuario_model->verificaUsuario()){
            $this->usuario_model->validarPermissaoDeAcesso('admin-sistema-log');
        }
    }
    
    public function view($page = 'busca',$data = array()){
	if ( ! file_exists(APPPATH.'/views/admin/usuario/nivel/'.$page.'.php')){
            // Whoops, we don't have a page for that!
            show_404();
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter
        $data['page'] = $page;
        
        $alerta = $this->session->flashdata('alerta');
        if ($alerta !== NULL) {
            $data[separa_str($alerta, '_', FALSE)] = $this->lang->line($alerta);
        }
        
        $this->load->view('templates/header', $data);
	$this->load->view('templates/top_bar_menu', $data);
        $this->load->view('admin/sistema/log/'.$page, $data);
        $this->load->view('templates/scripts',$data);
    }
    
    public function busca($data = array()){
        $pasta = './application/logs/';
        $map = directory_map($pasta, 1);
        $data['logs'] = $map;
        
        $this->view('busca',$data);
    }
    
    public function arquivo($nome){
        if($data == NULL){
            show_404();
        }
        $data['title'] = 'Arquivo de Log'; // Capitalize the first letter
        $data['page'] = 'arquivo';
        
        $this->load->view('templates/header', $data);
	$this->load->view('templates/top_bar_menu', $data);
        $this->load->file('application/logs/'.$nome);
        $this->load->view('templates/scripts',$data);
    }
}
