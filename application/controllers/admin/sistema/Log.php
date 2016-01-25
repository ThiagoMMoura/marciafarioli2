<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Controle para exibição de logs do sistema
 *
 * @author Thiago Moura
 */
class Log extends MY_Controller{
    
    public function __construct(){
        $config['control_url'] = 'admin/sistema/log';
        $config['login_required'] = TRUE;
        
        parent::__construct($config);
    }
    
//    public function view($page = 'busca',$data = array()){
//	if ( ! file_exists(APPPATH.'/views/admin/sistema/log/'.$page.'.php')){
//            // Whoops, we don't have a page for that!
//            show_404();
//        }
//
//        $data['title'] = ucfirst($page); // Capitalize the first letter
//        $data['page'] = $page;
//        
//        $alerta = $this->session->flashdata('alerta');
//        if ($alerta !== NULL) {
//            $data[separa_str($alerta, '_', FALSE)] = $this->lang->line($alerta);
//        }
//        
//        $this->load->view('templates/header', $data);
//	$this->load->view('templates/top_bar_menu', $data);
//        $this->load->view('admin/sistema/log/'.$page, $data);
//        $this->load->view('templates/scripts',$data);
//    }
    
    public function busca($data = array()){
        $this->load->helper('directory');
        
        $pasta = APPPATH.'/logs/';
        $map = directory_map($pasta, 1);
        
        $logs = array();
        $i = 0;
        foreach($map as $log){
            if($log!=NULL && $log!='index.html'){
                $logs[$i] = $log;
                $i++;
            }
        }
        
        arsort($logs);
        $data['logs'] = $logs;
        
        $this->view('busca',$data);
    }
    
    public function arquivo($nome){
        if(! file_exists(APPPATH.'/logs/'.$nome)){
            show_404();
        }
        $this->load->helper('typography');
        
        $data['title'] = 'Arquivo de Log'; // Capitalize the first letter
        $data['page'] = 'arquivo';
        if(!isset($data['logged'])){$data['logged'] = $this->_logged();}
        if(!isset($data['urls_restritas'])){$data['urls_restritas'] = $this->usuario_model->get_urls_restritas($this->session->idnivel);}
        
        $str_file = nl2br_except_pre($this->load->file(APPPATH.'/logs/'.$nome,TRUE));
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/top_bar_menu', $data);
        echo '<div class="row">' . $str_file . '</div>';
        $this->load->view('templates/scripts',$data);
    }
}