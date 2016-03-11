<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Thiago Moura
 */
class Carrosel extends MY_Controller {

    public function __construct() {
        $config['control_url'] = 'admin/pagina/home/carrosel';
        $config['login_required'] = TRUE;

        parent::__construct($config);

        $this->_set_campos_padrao();
        $this->load->library('image_lib');
    }

    public function index() {
        $this->busca();
    }
    
    public function adicionar($data = array()){
        $this->view('adicionar',$data);
    }
    
    public function busca($data = array()){
        $this->view('busca',$data);
    }
    public function upload() {
        $pasta = 'tmp_data/';
        if (!is_dir($pasta)) {
            mkdir($pasta);
        }

        $config['upload_path'] = $pasta;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 2048;
        $config['max_width'] = 4000;
        $config['max_height'] = 4000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $data = array('error' => $this->upload->display_errors('', ''));
            $this->load->view('templates/alertas', $data);
        } else {
            $data = $this->upload->data();
            echo json_encode(array('src' => base_url() . $config['upload_path'] . $data['file_name']));
            //echo img(array('src' => base_url() . $config['upload_path'] . $data['file_name'], 'id' => 'crop-img', 'width' => $data['image_width'], 'height' => $data['image_height']));
        }
    }

    public function salvar($data = array()) {
        if(empty($data)){
            $data = $this->input->post();
        }
        
        if($data['acao'] === 'upload'){
            $this->upload();
        }else{
            $img = str_replace(base_url(), '', $data['url_uploaded']);
            if (isset($data['cancelar'])) {
                $this->cancelar($img);
            }

            $nome = date('YmdHis') . random_string('alnum', 16) . strrchr($data['url_uploaded'], '.');
            $pasta = 'images/site/pagina/home/carrosel/';
            if (!is_dir($pasta)) {
                mkdir($pasta,0777,TRUE);
            }

            list($largura, $altura) = getimagesize($img);
            $w = ($data['w'] * 100 / $data['real_w']) * $largura / 100;
            $h = ($data['h'] * 100 / $data['real_h']) * $altura / 100;
            $x = ($data['x'] * 100 / $data['real_w']) * $largura / 100;
            $y = ($data['y'] * 100 / $data['real_h']) * $altura / 100;

            $img_cfg['image_library'] = 'gd2';
            $img_cfg['source_image'] = $img;
            $img_cfg['new_image'] = $pasta . $nome;
            $img_cfg['maintain_ratio'] = FALSE;
            $img_cfg['width'] = $w;
            $img_cfg['height'] = $h;
            $img_cfg['x_axis'] = $x;
            $img_cfg['y_axis'] = $y;

            $this->image_lib->initialize($img_cfg);

            if (!$this->image_lib->crop()) {
                echo $this->image_lib->display_errors();
            } else {
                unlink($img_cfg['source_image']);
                redirect('admin/pagina/home/carrosel/busca');
            }
        }
    }

    public function excluir($nome = NULL) {
        if ($nome === NULL){
            $nome = $this->input->post('nome');
        }
        unlink('./images/site/pagina/home/carrosel/' . $nome);
        $this->session->set_flashdata('alerta', 'success_excluded_image');
        redirect('admin/pagina/home/carrosel');
    }

    public function cancelar($url_uploaded = NULL) {
        if ($url_uploaded === NULL) {
            $url_uploaded = $this->input->post('url_uploaded');
        }
        $nome_arquivo = strrchr($url_uploaded, '/');
        if(unlink('tmp_data' . $nome_arquivo)){
            if($this->input->post('ajax')){
                echo 1;
                return 1;
            }else{
                redirect('admin/pagina/home/carrosel/adicionar');
            }
        }
        echo 0;
        return 0;
    }
    
    private function _set_campos_padrao(){
        $default_page_fields = array(
            'adicionar' => array(
                'acao' => 'upload',
                'url_uploaded' => '',
                'max_width_image_carrosel' => $this->config->item('max-width-image-carrosel'),
                'max_height_image_carrosel' => $this->config->item('max-height-image-carrosel')
            )
        );
        $this->_set_default_page_fields($default_page_fields);
        
        $page_head_elements = array(
            'adicionar' => array(
                'links' => array(
                    PLUGIN_PATH . '/jcrop/css/jquery.Jcrop.min.css'
                )
            )
        );
        $this->_set_page_head_elements($page_head_elements);
    }

}