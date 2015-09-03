<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function separa_str($str,$char='_',$array=TRUE){
	$str = explode($char,$str);
	if($array) return $str;
	else return $str[0];
}

?>