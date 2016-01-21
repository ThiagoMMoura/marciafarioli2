﻿<?php
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

/**
 * Retorna o HTML completo do menu ou menus passados por parâmetro.
 * 
 * @param   mixed   $data
 * @param   string  $url
 * @param   string  $tipo
 * @param   string  $formato
 * @param   string  $icone
 * @return  string
 */
function menu($data,$url = '',$tipo = '', $formato = '',$icone = ''){
    $html = '';
    $nome = '';
    if(is_array($data)){
        if(isset($data['url'])){
            $url = $data['url'];
            unset($data['url']);
        }
        if(isset($data['tipo'])){
            $tipo = $data['tipo'];
            unset($data['tipo']);
        }
        if(isset($data['formato'])){
            $formato = $data['formato'];
            unset($data['formato']);
        }
        if(isset($data['icone'])){
            $icone = $data['icone'];
            unset($data['icone']);
        }
        if(isset($data['nome'])){
            $nome = $data['nome'];
            unset($data['nome']);
        }
        
        if(empty($tipo) && !empty($data)){
            foreach($data as $dt){
                $html .= menu($dt);
            }
        }
    }else{
        $nome = $data;
    }
    
    if($tipo == 'menu'){
        if($formato == 'dropdown'){
            $html .= '<li class="has-dropdown">' . anchor($url, $nome) . '<ul class="dropdown">';
            foreach($data as $item){
                $html .= menu($item);
            }
            $html .= '</ul></li>';
        }else{
            $html .= achor($url,$nome);
        }
    }elseif($tipo == 'item'){
        $html .= '<li';
        switch($formato){
            case 'button':
                $html .= ' class="has-form"><a class="button" href="' . $url . '">' . $nome . '</a>';
                break;
            case 'divider':
                $html .= ' class="divider">';
            case 'label':
                $html .= '><label>' . $nome . '</label>';
                break;
            case 'link':
                $html .= '>' . anchor($url, $nome);
                break;
            default: $html .= '>' . menu($data);
        }
        $html .= '</li>';
    }elseif($tipo == 'posicao'){
        $html .= '<ul class="';
        if($formato == 'direita'){
            $html .= 'right';
        }else{
            $html .= 'left';
        }
        $html .= '">' . menu($data) . '</ul>';
    }elseif ($tipo == 'secao') {
        $html .= '<section class="top-bar-section">';
        $html .= menu($data);
        $html .= '</section>';
    }
    return $html;
}
//TIPO - secao(section),item(link, label, divider, button),menu(dropdown,link),posicao(direita,esquerda)
//FORMATO - link, label, divider, button, direita, esquerda, dropdown, section
