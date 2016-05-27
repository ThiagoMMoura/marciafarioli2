<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Portfolio
 *
 * @author Thiago Moura
 */
class Portfolio extends MY_Controller{
    public function __construct(){
        $config['control_url'] = 'admin/site/portfolio';
        $config['login_required'] = TRUE;
        
        parent::__construct($config);
        
        $this->load->model('album_model');
        $this->load->model('midia_model');
        $this->_set_campos_padrao();
    }
    
    public function albuns($biblioteca = 'imagem'){
        $query = $this->db->query("SELECT a.*,m.url AS urlcapa FROM album a LEFT JOIN midia m ON m.id = a.idcapa WHERE a.biblioteca = '".$biblioteca."' AND a.classificacao = 'portfolio'");
        $data['albuns'] = $query->result_array();
        $this->view('albuns',$data);
    }
    
    public function album($id){
        $data = array();
        if($id!==NULL){
            $data['album'] = $this->album_model->get_array_by_id($id);
            $data['fotos'] = $this->midia_model->selecionar('*','idalbum = '.$id);
            return $this->view('album',$data);
        }
        $this->index();
    }
    
    private function _set_campos_padrao(){
        $default_page_fields = array(
            'albuns' => array(
                'albuns' => array(),
                'url_imagem_sem_capa' => $this->midia_model->url_imagem_padrao($this->config->item('imagem-sem-capa'))
            ),
            'album' => array(
                'album' => array(),
                'fotos' => array()
            )
        );
        
        $this->_set_default_page_fields($default_page_fields);
    }
}
