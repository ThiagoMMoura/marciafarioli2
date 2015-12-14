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

    public function inserir($post = TRUE){
        if($post){
            $this->PostVariaveis();
        }
        return $this->db->insert($this->dbtable,$this->getCampos());
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


    public function alterar($post = TRUE){
        if($post){
            $this->PostVariaveis();
        }
        return $this->db->update($this->dbtable, $this->getCampos(), array('id' => $this->getId));
    }

    public function selecionar($colunas = NULL,$where = NULL,$orderBy = NULL){
        if($colunas==NULL)$colunas = '*';
        if($where==NULL)$where = '';
        if($orderBy==NULL)$orderBy = '';

        $this->db->select($colunas);
        $this->db->where($where);
        $this->db->order_by($orderBy);
        $this->setQuery($this->db->get($this->dbtable));
        return $this->getResultadosArray();
    }

    public function getObjectById($id){
        if($id!=NULL&&$id!=''){
            $this->db->where('id = '.$id);
            $this->setCampos($this->db->get($this->dbtable)->first_row());
            return $this;
        }
        return NULL;
    }
}
?>
