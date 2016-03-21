<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Album
 *
 * @author Thiago Moura
 */
class Album extends MY_Controller{
    public function __construct(){
        $config['control_url'] = 'admin/sistema/album';
        $config['login_required'] = TRUE;
        
        parent::__construct($config);
        
        $this->load->helper('date');
        $this->load->model('album_model');
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
            $data = $this->album_model->get_array_by_id($id);
            $data['idalbum'] = $id;
            return $this->cadastro($data);
        }
        $this->index();
    }
    
    public function salvar(){
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|min_length[3]|max_length[100]');
        $this->form_validation->set_rules('descricao', 'Descricao', 'trim|max_length[300]');
        $this->form_validation->set_rules('url', 'URL', 'trim|min_length[3]|max_length[200]');
        $this->form_validation->set_rules('biblioteca','Biblioteca','trim|required|max_length[100]');
        $this->form_validation->set_rules('classificacao','Classificação','trim|required|max_length[100]');
        $this->form_validation->set_rules('idcategoria','Categoria','required');
        $this->form_validation->set_rules('idusuario','Usuario','required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->cadastro();
        }else{
            $album = new Album_model();
            $album->getObjectById($this->input->post('idalbum'));
            
            $album->nome = $this->input->post('nome');
            $album->descricao = $this->input->post('descricao');
            $album->biblioteca = $this->input->post('biblioteca');
            $album->classificacao = $this->input->post('classificacao');
            $album->idcategoria = $this->input->post('idcategoria');
            $album->idusuario = $this->input->post('idusuario');
            $album->idcapa = $this->input->post('idcapa');
            
            if($album->getId()==0){
                $album->url = 'images/portfolio/'.date('Y').'/'.date('m').'/'.str_replace(' ','_',strtolower($album->nome)).'/';
                $album->criado = date('Y-m-d H:i:s');
            }
            
            if($album->salvar(FALSE)){
                $this->session->set_flashdata('alerta', 'success_save');
                redirect('admin/sistema/album/editar/'.$album->getId());
            }
            $this->session->set_flashdata('alerta', 'error_save');
            $this->cadastro($album->get_fields_array());
        }
    }
    
    private function _categoria_busca($data = array()){
        $this->view('categoria/busca',$data);
    }
    
    private function _categoria_cadastro($data = array()){
        $this->view('categoria/cadastro',$data);
    }
    
    private function _categoria_editar($id = ''){
        $data = array();
        if($id!==NULL){
            $data = $this->categoria_album_model->get_array_by_id($id);
            $data['idcategoria'] = $id;
            return $this->_categoria_cadastro($data);
        }
        $this->_categoria_busca();
    }
    
    private function _categoria_salvar(){
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|min_length[3]|max_length[100]');
        
        if ($this->form_validation->run() == FALSE) {
            $this->_categoria_cadastro();
        }else{
            $categoria = new Categoria_album_model();
            $categoria->setId($this->input->post('idcategoria'));
            $categoria->nome = $this->input->post('nome');
            $categoria->idsobcategoria = $this->input->post('idsobcategoria');
            
            if($categoria->salvar(FALSE)){
                $this->session->set_flashdata('alerta', 'success_save');
                redirect('admin/sistema/album/categoria/editar/'.$categoria->getId());
            }
            $this->session->set_flashdata('alerta', 'error_save');
            $this->_categoria_cadastro($categoria->get_fields_array());
        }
    }
    
    public function categoria($tela = 'busca',$data = array()){
        switch ($tela){
            case 'busca':{
                $this->_categoria_busca();
                break;
            }case 'cadastro':{
                $this->_categoria_cadastro();
                break;
            }case 'editar':{
                $this->_categoria_editar($data);
                break;
            }case 'salvar':{
                $this->_categoria_salvar();
            }
        }
    }
    
    private function _set_campos_padrao(){
        $default_page_fields = array(
            'cadastro' => array(
                'idalbum' => '',
                'nome' => '',
                'descricao' => '',
                'url' => '',
                'biblioteca' => '',
                'classificacao' => '',
                'idcategoria' => '0',
                'idusuario' => '0',
                'idcapa' => '0',
                'criado' => date('Y-m-d H:i:s'),
                'bibliotecas' => array('imagem'=>'Imagens','video'=>'Videos','audio'=>'Audios','documento'=>'Documentos'),
                'classificacoes' => array('usuario'=>'Usuario','site'=>'Site','sistema'=>'Sitema','portfolio'=>'Portfolio'),
                'categorias' => $this->categoria_album_model->getOptionsArray('nome','','nome ASC'),
                'usuarios' => $this->_get_options_usuario()
                ),
            'busca' => array(
                'albuns' => $this->album_model->selecionar('*','','criado DESC')
                ),
            'categoria/cadastro' => array(
                'idcategoria' => '0',
                'nome' => '',
                'idsobcategoria' => '0',
                'sobcategorias' => array_merge(array('0'=>''),$this->categoria_album_model->getOptionsArray('nome','','nome ASC')),
                ),
            'categoria/busca' => array(
                'categorias' => $this->categoria_album_model->selecionar('*','','nome ASC')
                )
            );
            
        $this->_set_default_page_fields($default_page_fields);
    }
    
    private function _get_options_usuario(){
        $usuarios[0] = '';
        foreach($this->usuario_model->selecionar('id,nome,email','','nome ASC') as $usuario){
            $usuarios[$usuario['id']] = $usuario['nome'] . ' (' . $usuario['email'] . ')';
        }
        return $usuarios;
    }
}
