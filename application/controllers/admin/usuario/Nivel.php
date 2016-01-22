<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Nivel
 *
 * @author Thiago Moura
 */
class Nivel extends MY_Controller{
    
    public function __construct(){
        $config['control_url'] = 'admin/usuario/nivel';
        $config['login_required'] = TRUE;
        
        parent::__construct($config);
        $this->_set_campos_padrao();
    }
    
    public function index(){
        $this->view('busca');
    }
      
    public function editar($id = NULL){
        $data = array();
        if($id!==NULL){
            $this->nivel_model->selecionar('*','id =' . $id);
            $query = $this->nivel_model->getQuery();
            $data = $query->row_array();
            $data['idnivel'] = $id;
            $data['permissoes'] = $this->permissao_model->selecionar('*','idnivel = ' . $id,'idurl ASC');
            return $this->view('cadastro',$data);
        }
        $this->index();
    }
    
    public function salvar(){
        $is_unique = $this->input->post('idnivel')==NULL?"|is_unique[nivel.nome]":'';
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|min_length[3]|max_length[100]'.$is_unique);
        $this->form_validation->set_rules('email', 'Email', 'trim|max_length[300]');
        $this->form_validation->set_rules('hierarquia','Hierarquia','required|integer|less_than_equal_to[100]|greater_than['.($this->usuario_model->get_hierarquia()) .']');
        
        if ($this->form_validation->run() == FALSE) {
            $this->view('cadastro');
        }else{
            $this->nivel_model->setId($this->input->post('idnivel'));
            $this->nivel_model->nome = $this->input->post('nome');
            $this->nivel_model->descricao = $this->input->post('descricao');
            $this->nivel_model->hierarquia = $this->input->post('hierarquia');
            
            if($this->nivel_model->salvar(FALSE)){
                foreach($this->input->post('idurl') as $id){
                    $this->permissao_model = new Permissao_model();
                    $this->permissao_model->setId($this->input->post('idpermissao'.$id));
                    $this->permissao_model->idnivel     = $this->nivel_model->getId();
                    $this->permissao_model->idurl      = $id;
                    $this->permissao_model->permite   = (string) $this->input->post('permite'.$id);
                    
                    if($this->permissao_model->permite OR  $this->permissao_model->getId()!=NULL){
                        $this->permissao_model->salvar(FALSE);
                    }
                }
                $this->session->set_flashdata('alerta', 'success_save');
                redirect($this->control_url . '/editar/'.$this->nivel_model->getId());
            }else{
                $this->session->set_flashdata('alerta', 'error_save');
                $this->view('cadastro');
            }
        }
    }
    
    private function _set_campos_padrao(){
        $default_page_fields = array(
            'cadastro' => array(
                'idnivel' => '',
                'nome' => '',
                'descricao' => '',
                'hierarquia' => '',
                'hierarquia_min' => $this->usuario_model->get_hierarquia() + 1,
                'urls' => $this->url_model->selecionar('*', 'restricao = 1', 'nome ASC'),
                'permissoes' => array()
            ),
            'busca' => array(
                'niveis' => $this->nivel_model->selecionar('*', NULL, 'nome')
            )
        );
        $this->_set_default_page_fields($default_page_fields);
    }
}
