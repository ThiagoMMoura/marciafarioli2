<?php
defined('BASEPATH') OR exit('No direct script access allowed');
function script_tag($src = '', $codigo = '', $type = 'text/javascript', $index_page = FALSE){
	$CI =& get_instance();
	$script = '<script ';

	if (is_array($src))
	{
		foreach ($src as $k => $v)
		{
			if ($k === 'src' && ! preg_match('#^([a-z]+:)?//#i', $v))
			{
				if ($index_page === TRUE)
				{
					$script .= 'src="'.$CI->config->site_url($v).'" ';
				}
				else
				{
					$script .= 'src="'.$CI->config->slash_item('base_url').$v.'" ';
				}
			}
			elseif($k === 'codigo')
			{
				$codigo = $v;
			}
			else
			{
				$script .= $k.'="'.$v.'" ';
			}
		}
	}
	else
	{
		if (preg_match('#^([a-z]+:)?//#i', $src))
		{
			$script .= 'src="'.$src.'" ';
		}
		elseif ($index_page === TRUE)
		{
			$script .= 'src="'.$CI->config->site_url($src).'" ';
		}
		else
		{
			$script .= 'src="'.$CI->config->slash_item('base_url').$src.'" ';
		}

		$script .= 'type="'.$type.'" ';

	}

	return $script.">".$codigo."</script>\n";
}
function alert_div($mensagem='',$tipo='info',$fechavel=TRUE){
	if(is_array($mensagem)) {
            return FALSE;
        }
	$alert = '<div data-alert class="alert-box ';
	$alert .= $tipo;
	$alert .= '" >';
	$alert .= $mensagem;
	if($fechavel===TRUE){
            $alert .= '<a href="#" class="close">&times;</a>';
        }
	$alert .= '</div>';
	return $alert;
}

function menu($data = array()){
    $html = '';
    if(is_array($data)){
        foreach($data as $menu){
            switch($menu['tipo']){
                case 'link':
                    $html .= anchor($menu['url'], $menu['nome']);
                    break;
                case 'separador':
                    $html .= '<li class="divider"></li>';
                    break;
                case 'dropdown':
                    if(isset($menu['itens'])){
                        $html .= '<li class="has-dropdown">';
                        $html .= anchor($menu['url'], $menu['nome']);
                        $html .= '<ul class="dropdown">';
                        $html .= menu($menu['itens']);
                    }elseif ($menu['url']!=NULL) {
                        $html .= anchor($menu['url'], $menu['nome']);
                    }
                    break;
            }
        }
    }
}