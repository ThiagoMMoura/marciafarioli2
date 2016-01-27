<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html class="no-js" lang="pt">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Marcia Farioli - <?= $title ?></title>
	
    <?php 
    $link_list = array(
        'padrao'=>array(
            NORMALIZE_CSS_FILE_LOCAL,
            RESPONSIVE_FW_CSS_FILE_LOCAL,
            FONTES_PATH . '/foundation-icons/foundation-icons.css',
            APP_CSS_FILE_LOCAL
            ),
        'home'=>array(
            SLICK_CSS_FILE_LOCAL,
            SLICK_THEME_CSS_FILE_LOCAL,
            CSS_PATH . '/home.css'
            ),
        'editar/carrosel'=>array(
            PLUGIN_PATH . 'assets/plugin/jcrop/css/jquery.Jcrop.min.css',
            )
        );

    foreach($link_list['padrao'] as $key => $link_item){
            echo link_tag($link_item);
    }
    if(array_key_exists($page,$link_list)){
        foreach($link_list[$page] as $key => $link_item){
            echo link_tag($link_item);
        }
    }
    
    echo script_tag(MODERNIZR_JS_FILE_LOCAL);
    ?>
</head>

<body>