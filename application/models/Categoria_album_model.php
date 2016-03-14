<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
 * Description of Categoria_album_model
 *
 * @author Thiago Moura
 */
class Categoria_album_model extends MY_Model{
    /**
     * @var string 
     */
    public $nome;
    /**
     * @var int 
     */
    public $idsobcategoria;
    
    public function __construct() {
        parent::__construct();
        $this->dbtable = 'categoria_album';
    }
}
