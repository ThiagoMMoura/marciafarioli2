<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html class="no-js" lang="pt">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Marcia Farioli - <?php echo $title ?></title>
	
	<?php 
	$link_list = array(
			'padrao'=>array(NORMALIZE_CSS_FILE_LOCAL,
					RESPONSIVE_FW_CSS_FILE_LOCAL,
					APP_CSS_FILE_LOCAL),
			'home'=>array(NORMALIZE_CSS_FILE_LOCAL,
					RESPONSIVE_FW_CSS_FILE_LOCAL,
					SLICK_CSS_FILE_LOCAL,
					SLICK_THEME_CSS_FILE_LOCAL,
					APP_CSS_FILE_LOCAL),
			'editar/carrosel'=>array(
					NORMALIZE_CSS_FILE_LOCAL,
					RESPONSIVE_FW_CSS_FILE_LOCAL,
					'assets/plugin/jcrop/css/jquery.Jcrop.min.css',
					APP_CSS_FILE_LOCAL
					)
			);
			
	$link_list_name = isset($link_list[$page])?$page:'padrao';
	foreach($link_list[$link_list_name] as $key => $link_item){
		echo link_tag($link_item);
	}
	
	echo script_tag(MODERNIZR_JS_FILE_LOCAL);
	?>
  </head>

<body>