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
            $data = $this->album_model->get_array_by_id($id);
            $data['fotos'] = $this->midia_model->selecionar('*','idalbum = '.$id);
            return $this->view('album',$data);
        }
        $this->index();
    }
    
    public function upload(){
        $pasta = $this->input->post('url');
        if (!is_dir($pasta)) {
            mkdir($pasta,0777,TRUE);
        }
        
        if(is_array($_FILES['files']['name'])){
            $_FILES['userfile']['name'] = $_FILES['files']['name'][0];
            $_FILES['userfile']['type'] = $_FILES['files']['type'][0];
            $_FILES['userfile']['tmp_name'] = $_FILES['files']['tmp_name'][0];
            $_FILES['userfile']['error'] = $_FILES['files']['error'][0];
            $_FILES['userfile']['size'] = $_FILES['files']['size'][0];
        }else{
            $_FILES['userfile'] = $_FILES['files'];
        }
        $name = strtolower($_FILES['userfile']['name']);
        $config['file_name'] = str_replace(array(' ','?','&'), array('_','','e'), $name);
        $config['upload_path'] = $pasta;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = $this->config->item('max-size-image-upload');
        $config['max_width'] = $this->config->item('max-width-image-upload');
        $config['max_height'] = $this->config->item('max-height-image-upload');

        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload()) {
            $data = array('error' => $this->upload->display_errors('', ''));
            $this->load->view('templates/alertas', $data);
        } else {
            $data = $this->upload->data();
            if($this->midia_model->add_imagem_portfolio($data['file_name'], $pasta . $data['file_name'], $this->input->post('id'))){
                $imagem = $this->midia_model->getInserido();
                $imagem['url'] = base_url() . $imagem['url'];
                echo json_encode(array('estatus' => 'sucesso','imagem'=>$imagem));
            }else{
                $mensagem = array('error'=>$this->lang->line('error_insert_failed'));
		echo json_encode(array('alertas'=>$this->load->view('templates/alertas',$mensagem,TRUE),'estatus'=>'falha'));
            }
        }
    }
    
    public function excluir($id = ''){
        if($id == ''){
            $id = $this->input->post('id');
        }
        
        $data = $this->midia_model->get_array_by_id($id);
        if(unlink($data['url'])){
            if($this->midia_model->deletar($id)!== FALSE){
                echo json_encode(array('estatus'=>'sucesso'));
                return;
            }
        }
        $mensagem = array('error'=>$this->lang->line('error_deleting_image'));
        echo json_encode(array('alertas'=>$this->load->view('templates/alertas',$mensagem,TRUE),'estatus'=>'falha'));
    }
    
    public function alterar_capa(){
        $this->album_model->setId($this->input->post('idalbum'));
        $this->album_model->idcapa = $this->input->post('idcapa');
        $this->album_model->set_fields_update_only(array('idcapa'));
        if($this->album_model->salvar(FALSE)){
            echo json_encode(array('estatus'=>'sucesso'));
        }else{
            $mensagem = array('error'=>$this->lang->line('error_changing_cover'));
            echo json_encode(array('alertas'=>$this->load->view('templates/alertas',$mensagem,TRUE),'estatus'=>'falha'));
        }
    }

    private function _set_campos_padrao(){
        $default_page_fields = array(
            'albuns' => array(
                'albuns' => array(),
                'url_imagem_sem_capa' => $this->midia_model->url_imagem_padrao($this->config->item('imagem-sem-capa'))
            ),
            'album' => array(
                'id'=>'0',
                'nome'=>'',
                'descricao'=>'',
                'fotos' => array(),
                'url_imagem_add' => $this->midia_model->url_imagem_padrao($this->config->item('image-adicionar-upload')),
                'url_ajax_load_gif' => $this->midia_model->url_imagem_padrao($this->config->item('ajax-load-up-img'))
            )
        );
        
        $this->_set_default_page_fields($default_page_fields);
        
        $page_head_elements = array(
            'album' => array(
                'links' => array(
                    PLUGIN_PATH . '/jquery_filer/css/jquery.filer.css',
                    PLUGIN_PATH . '/jquery_filer/css/themes/jquery.filer-dragdropbox-theme.css'
                ),
                'script' => array(
                    PLUGIN_PATH . '/jquery_filer/js/jquery.filer.min.js'
                )
            )
        );
        $this->_set_page_head_elements($page_head_elements);
    }
}
