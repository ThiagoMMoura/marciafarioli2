<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
 * Modela a tabela <b>restricao</b>
 *
 * @author Thiago Moura
 */
class Restricao_model extends MY_Model{
    /**
     * @var string 
     */
    public $nome;
    /**
     * @var string 
     */
    public $descricao;
    /**
     * @var string 
     */
    public $url;
    
    public function __construct() {
        parent::__construct();
        $this->dbtable = 'restricao';
    }
}
