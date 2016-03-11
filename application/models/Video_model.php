<?php
class Video_model extends MY_Model{
	
	public $id;
	public $idplaylist;
	public $idcategoria;
	
	public function __construct(){
		parent::__construct();
	}
}
?>