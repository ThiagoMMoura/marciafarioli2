<?php

/**
 * Classe Controle para testes.
 *
 * @author 61171
 */
class Teste extends MY_Controller{
    public function __construct(){
        parent::__construct('admin/usuario/nivel/',TRUE);
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
            $data['permissoes'] = $this->permissao_model->selecionar('*','idnivel = ' . $id,'idmenu ASC');
            return $this->view('cadastro',$data);
        }
        $this->index();
    }
    
    public function salvar(){
        $is_unique = $this->input->post('idnivel')==NULL?"|is_unique[nivel.nome]":'';
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|min_length[3]|max_length[100]'.$is_unique);
        $this->form_validation->set_rules('email', 'Email', 'trim|max_length[300]');
        
        if ($this->form_validation->run() == FALSE) {
            $this->view('cadastro');
        }else{
            $this->nivel_model->setId($this->input->post('idnivel'));
            $this->nivel_model->nome = $this->input->post('nome');
            $this->nivel_model->descricao = $this->input->post('descricao');
            
            if($this->nivel_model->salvar(FALSE)){
                foreach($this->input->post('idmenu') as $id){
                    $this->permissao_model = new Permissao_model();
                    $this->permissao_model->setId($this->input->post('idpermissao'.$id));
                    $this->permissao_model->idnivel     = $this->nivel_model->getId();
                    $this->permissao_model->idmenu      = $id;
                    $this->permissao_model->consultar   = (string) $this->input->post('consultar'.$id);
                    $this->permissao_model->incluir     = (string) $this->input->post('incluir'.$id);
                    $this->permissao_model->editar      = (string) $this->input->post('editar'.$id);
                    $this->permissao_model->excluir     = (string) $this->input->post('excluir'.$id);
                    
                    if(($this->permissao_model->consultar OR $this->permissao_model->incluir OR
                            $this->permissao_model->editar OR $this->permissao_model->excluir) OR  $this->permissao_model->getId()!=NULL){
                        $this->permissao_model->salvar(FALSE);
                    }
                }
                $this->session->set_flashdata('alerta', 'success_save');
                redirect('admin/usuario/nivel/editar/'.$this->nivel_model->getId());
            }else{
                $this->session->set_flashdata('alerta', 'error_save');
                $this->view('cadastro');
            }
        }
    }
}
