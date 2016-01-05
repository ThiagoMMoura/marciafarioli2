<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Classe que define funções básicas para as classes model
 *
 * @author Thiago Moura
 */
class MY_Model extends CI_Model{
    protected $dbtable;
    protected $dbcolunas;
    protected $query;
    private $id;

    public function __construct(){
        parent::__construct();
        $this->query = NULL;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($sid){
        $this->id = $sid;
    }

    public function getQuery() {
        return $this->query;
    }

    private function setQuery($query) {
        $this->query = $query;
    }

    public function getResultados() {
        $lista = array();
        $i = 0;
        if($this->query!==NULL){
            foreach($this->query->result() as $result){
                $lista[$i] = new $this();
                $lista[$i]->setCampos($result);
                $i++;
            }
        }
        return $lista;
    }
    
    public function getResultadosArray() {
        return $this->query!=NULL?$this->query->result_array():array();
    }
    
    public function getNumRows(){
        return $this->query!=NULL?$this->query->num_rows():0;
    }
    
    public function PostVariaveis(){
        if ($this->dbcolunas == NULL) {
            $this->dbcolunas = $this->db->list_fields($this->dbtable);
        }
        foreach($this->dbcolunas as $coluna){
            if($this->input->post($coluna)!=NULL) {
                $this->{$coluna} = $this->input->post($coluna);
            }
        }
    }

    public function getCampos(){
        $cmp = array();
        if ($this->dbcolunas == NULL) {
            $this->dbcolunas = $this->db->list_fields($this->dbtable);
        }
        foreach($this->dbcolunas as $coluna){
            if($this->{$coluna}!=NULL){
                $cmp[$coluna] = $this->{$coluna};
            }
        }
        return $cmp;
    }

    public function limpaCampos(){
        $cmp = array();
        if ($this->dbcolunas == NULL) {
            $this->dbcolunas = $this->db->list_fields($this->dbtable);
        }
        foreach($this->dbcolunas as $coluna){
            $this->{$coluna} = NULL;
        }
        return $cmp;
    }

    public function setCampos($campos){
        foreach($campos as $campo => $value){
            $this->{$campo} = $value;
        }
    }

    /**
     * Função para inserir um registro no banco. Gera um INSERT SQL.
     * 
     * @param boolean $post Por padrão TRUE, a função busca os valores a serem salvos
     * no método post.
     * @return boolean TRUE em caso de sucesso, FALSE em caso de falha.
     */
    public function inserir($post = TRUE){
        if($post){
            $this->PostVariaveis();
        }
        if($this->db->insert($this->dbtable,$this->getCampos())){
            $this->id = $this->db->insert_id();
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function getInserido(){
        $query = $this->selecionar(NULL,'id = '.$this->db->insert_id());
        $result = $query->row_array();
        $this->setCampos($result);
        return $result;
    }

    public function getInsertObject(){
        $query = $this->selecionar(NULL,'id = '.$this->db->insert_id());
        $this->setCampos($query->row_array());
        return $this;
    }

    /**
     * Função para atualizar um registro no banco pela id. Gera um UPDATE SQL.
     * 
     * @param boolean $post Por padrão TRUE, a função busca os valores a serem salvos
     * no método post.
     * @return boolean TRUE em caso de sucesso, FALSE em caso de falha.
     */
    public function alterar($post = TRUE){
        if($post){
            $this->PostVariaveis();
        }
        return $this->db->update($this->dbtable, $this->getCampos(), array('id' => $this->getId));
    }
    
    /**
     * Função para salvar registro como INSERT ou UPDATE conforme presença ou não de id.
     * 
     * @param boolean $post Por padrão TRUE, a função busca os valores a serem salvos
     * no método post.
     * @return boolean TRUE em caso de sucesso, FALSE em caso de falha.
     */
    public function salvar($post = TRUE){
        if($post){
            $this->PostVariaveis();
        }
        if($this->id!==NULL && $this->id>0){
            return $this->alterar(FALSE);
        }else{
            return $this->inserir(FALSE);
        }
    }
    
    /**
     * Método personalizavel para selecionar registros do banco.
     * 
     * @param String $colunas
     * @param String $where
     * @param String $orderBy
     * @param String $groupBy
     * @return array - Retorna todos as linhas e colunas em uma matriz.
     */
    public function selecionar($colunas = '*',$where = '',$orderBy = '',$groupBy = ''){
        $this->db->select($colunas===NULL?'*':$colunas);
        
        if($where!==NULL){
            $this->db->where($where);
        }
        if($orderBy!==NULL){
            $this->db->order_by($orderBy);
        }
        if($groupBy!==NULL){
            $this->db->group_by($groupBy);
        }
        
        $this->setQuery($this->db->get($this->dbtable));
        return $this->getResultadosArray();
    }

    /**
     * Método para retornar o objeto de um registro com a id passada por parâmetro.
     * 
     * @param int $id
     * @return \MY_Model
     */
    public function getObjectById($id){
        if($id!=NULL&&$id!=''){
            $this->db->where('id = '.$id);
            $this->setCampos($this->db->get($this->dbtable)->first_row());
            return $this;
        }
        return NULL;
    }
    
    /**
     * Função para retornar uma array de registros indexados pela id para montar um <code>select</code> em html.
     * 
     * @param string $coluna
     * @param string $where
     * @param string $orderBy
     * @return string - Retorna um array indexado pela id dos registros e o valor da coluna passada por parâmetro.
     */
    public function getOptionsArray($coluna,$where = '',$orderBy = ''){
        $result = $this->selecionar('id,'.$coluna,$where,$orderBy);
        $options = array();
        foreach($result as $row){
            $options[$row['id']] = $row[$coluna];
        }
        return $options;
    }
}

