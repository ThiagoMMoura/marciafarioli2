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
    protected $update_only;
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
    
    public function set_fields_sent_by_post(){
        if ($this->dbcolunas == NULL) {
            $this->dbcolunas = $this->db->list_fields($this->dbtable);
        }
        foreach($this->dbcolunas as $coluna){
            if($this->input->post($coluna)!=NULL) {
                $this->{$coluna} = $this->input->post($coluna);
            }
        }
    }

    /**
     * Retorna um array dos campos e seus respectivos valores.
     * 
     * @return array
     */
    public function get_fields_array($fields = array()){
        $cmp = array();
        if(empty($fields)){
            $fields = $this->get_list_fields();
        }
        foreach($fields as $coluna){
            if(($this->{$coluna}!=NULL OR $this->{$coluna}==0)){
                log_message('debug',$coluna . ' = '.$this->{$coluna});
                $cmp[$coluna] = $this->{$coluna};
            }
        }
        return $cmp;
    }
    
    /**
     * Retorna um array com o nome das colunas da tabela.
     * 
     * @return array
     */
    public function get_list_fields(){
        if ($this->dbcolunas == NULL) {
            $this->dbcolunas = $this->db->list_fields($this->dbtable);
        }
        return $this->dbcolunas;
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
        if($campos != NULL){
            foreach($campos as $campo => $value){
                $this->{$campo} = $value;
            }
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
            $this->set_fields_sent_by_post();
        }
        if($this->db->insert($this->dbtable,$this->get_fields_array())){
            $this->id = $this->db->insert_id();
            log_message('info','inserir SQL - '.$this->db->last_query());
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function getInserido(){
        $result = $this->get_array_by_id($this->db->insert_id());
        $this->setCampos($result);
        return $result;
    }

    public function getInsertObject(){
        $this->setCampos($this->getInserido());
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
            $this->set_fields_sent_by_post();
        }
        if($this->db->update($this->dbtable, $this->get_fields_array($this->update_only), array('id' => $this->id))){
            log_message('info','alterar SQL - '.$this->db->last_query());
            return TRUE;
        }else{
            return FALSE;
        }
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
            $this->set_fields_sent_by_post();
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
     * @param mixed $colunas
     * @param mixed $where
     * @param mixed $orderBy
     * @param mixed $groupBy
     * @return array - Retorna todos as linhas e colunas em uma matriz.
     */
    public function selecionar($colunas = '*',$where = '',$orderBy = '',$groupBy = '',$having = '',$distinct = FALSE){
        $this->db->select($colunas===NULL?'*':$colunas);
        
        if($where!=NULL){
            $this->db->where($where);
        }
        if($orderBy!=NULL){
            $this->db->order_by($orderBy);
        }
        if($groupBy!=NULL){
            $this->db->group_by($groupBy);
        }
        if($having!=NULL){
            $this->db->having($having);
        }
        $this->db->distinct($distinct);
        
        $this->setQuery($this->db->get($this->dbtable));
        log_message('info','selecionar SQL - '. preg_replace('/\s/', ' ',$this->db->last_query()));
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
            $this->setQuery($this->db->get($this->dbtable));
            
            if($this->getNumRows()==1){
                return $this->get_first_row();
            }
        }
        return NULL;
    }
    
    /**
     * Retorna um array de um registro relacionado com a id passado por parâmetro, ou
     * <b>NULL</b> se nenhum registro for encontrado.
     * 
     * @param integer $id
     * @return array
     */
    public function get_array_by_id($id){
        if($id!=NULL&&$id!=''){
            $this->selecionar('*','id = ' . $id);
            
            if($this->getNumRows()==1){
                return $this->get_first_row_array();
            }
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
    
    /**
     * Função para selecionar distintos de uma tabela.
     * 
     * @param string $coluna
     * @param mixed $where
     * @param mixed $order_by
     * @param mixed $group_by
     * @param mixed $having
     * @return array
     */
    public function selecionar_distinto($coluna,$where = '',$order_by = '',$group_by = '',$having = ''){
        return $this->selecionar($coluna, $where, $order_by, $group_by, $having, TRUE);
    }
    
    /**
     * Retorna um objeto da primeira row da ultima query executada.
     * @return \MY_Model
     */
    public function get_first_row(){
        $this->setCampos($this->get_first_row_array());
        return $this;
    }
    
    /**
     * Retorna um array da primeira linha da ultima query executada.
     * @return array
     */
    public function get_first_row_array(){
        return $this->query!=NULL?$this->query->row_array():array();
    }
    
    public function set_fields_update_only($fields){
        $this->update_only = $fields;
    }
    
    public function deletar($id){
        if($id!=NULL&&$id!=''){
            $this->db->where('id', $id);
            return $this->db->delete($this->dbtable);
        }
        return FALSE;
    }
}

