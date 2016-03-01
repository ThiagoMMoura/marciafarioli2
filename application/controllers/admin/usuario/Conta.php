<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of Conta
 *
 * @author Thiago Moura
 */
class Conta extends MY_Controller{
    public function __construct(){
        $config['control_url'] = 'admin/usuario/conta';
        $config['login_required'] = TRUE;
        
        parent::__construct($config);
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
            $data = $this->usuario_model->get_array_by_id($id);
            $data['idusuario'] = $id;
            return $this->cadastro($data);
        }
        $this->index();
    }
    
    public function salvar(){
        $is_unique = $this->input->post('idusuario')>0?'':'|is_unique[usuario.email]';
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[60]' . $is_unique,array('is_unique'=>'Este email já foi cadastrado, tente outro.'));
        if(!$this->input->post('idusuario')){
            $this->form_validation->set_rules('senha', 'Senha', 'trim|required|max_length[50]|md5');
        }
        $this->form_validation->set_rules('sexo','Sexo','required',array('required'=>'Selecione uma opção.'));
        $this->form_validation->set_rules('idnivel','Nivel','required',array('required'=>'Selecione uma opção.'));

        if ($this->form_validation->run() == FALSE) {
            $this->view('cadastro');
        }else{
            $usuario_model = new Usuario_model();
            $usuario_model->setId($this->input->post('idusuario'));
            $usuario_model->nome = $this->input->post('nome');
            $usuario_model->email = $this->input->post('email');
            $usuario_model->senha = $this->input->post('senha');
            $usuario_model->sexo = $this->input->post('sexo');
            $usuario_model->idnivel = $this->input->post('idnivel');
            
            $fields = array('id','nome','email','sexo','idnivel');
            if(!$this->input->post('idusuario')){
                $fields[] = 'senha';
            }
            
            $usuario_model->set_fields_update_only($fields);
            if($usuario_model->salvar(FALSE)){
                $this->session->set_flashdata('alerta', 'success_save');
                redirect('admin/usuario/conta/editar/' . $usuario_model->getId());
            }else{
                $this->session->set_flashdata('alerta','error_save');
                redirect('cadastro');
            }
        }
    }

    private function _set_campos_padrao(){
        $default_page_fields = array(
            'cadastro' => array(
                'idusuario' => '0',
                'nome' => '',
                'email' => '',
                'sexo' => 'Feminino',
                'idnivel' => $this->config->item('nivelusuariopadrao'),
                'niveis' => $this->_get_option_nivel()
            ),
            'busca' => array(
                'usuarios' => $this->usuario_model->selecionar('*', NULL, 'nome ASC')
            )
        );
        $this->_set_default_page_fields($default_page_fields);
    }
    
    private function _get_option_nivel(){
        $niveis = array();
        foreach($this->nivel_model->selecionar('*', NULL, 'hierarquia ASC, nome ASC') as $nivel){
            $niveis[$nivel['id']] = $nivel['hierarquia'] . ' - ' .$nivel['nome'];
        }
        return $niveis;
    }
}
