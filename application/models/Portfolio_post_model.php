<?php
class Portfolio_post_model extends MY_Model{
	
	public $id;
	public $idalbum;
	public $idcategoria;
	
	public function __construct(){
		parent::__construct();
	}
}
?>