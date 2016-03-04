<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html class="no-js" lang="pt">
    <head>
        <?php /* Bloco Favicon */ ?>
        <?= link_tag("images/site/favicon/favicon.ico", "icon", "image/x-icon");?>
        <link rel="apple-touch-icon" sizes="57x57" href="<?= base_url('images/site/favicon/apple-icon-57x57.png');?>"/>
        <link rel="apple-touch-icon" sizes="60x60" href="<?= base_url('images/site/favicon/apple-icon-60x60.png');?>"/>
        <link rel="apple-touch-icon" sizes="72x72" href="<?= base_url('images/site/favicon/apple-icon-72x72.png');?>"/>
        <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('images/site/favicon/apple-icon-76x76.png');?>"/>
        <link rel="apple-touch-icon" sizes="114x114" href="<?= base_url('images/site/favicon/apple-icon-114x114.png');?>"/>
        <link rel="apple-touch-icon" sizes="120x120" href="<?= base_url('images/site/favicon/apple-icon-120x120.png');?>"/>
        <link rel="apple-touch-icon" sizes="144x144" href="<?= base_url('images/site/favicon/apple-icon-144x144.png');?>"/>
        <link rel="apple-touch-icon" sizes="152x152" href="<?= base_url('images/site/favicon/apple-icon-152x152.png');?>"/>
        <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('images/site/favicon/apple-icon-180x180.png');?>"/>
        <link rel="icon" type="image/png" sizes="192x192"  href="<?= base_url('images/site/favicon/android-icon-192x192.png');?>"/>
        <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('images/site/favicon/favicon-32x32.png');?>"/>
        <link rel="icon" type="image/png" sizes="96x96" href="<?= base_url('images/site/favicon/favicon-96x96.png');?>"/>
        <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('images/site/favicon/favicon-16x16.png');?>"/>
        <link rel="manifest" href="<?= base_url('images/site/favicon/manifest.json');?>"/>
        <meta name="msapplication-TileColor" content="#ffffff"/>
        <meta name="msapplication-TileImage" content="<?= base_url('images/site/favicon/ms-icon-144x144.png');?>"/>
        <meta name="theme-color" content="#ffffff"/>
        <?php /* FIM Bloco Favicon */ ?>
        
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Marcia Farioli - <?= $title ?></title>

        <?php 
        foreach($page_head_elements as $key => $value){
            foreach($page_head_elements[$key] as $element){
                switch($key){
                    case 'link':case 'links':{
                        echo link_tag($element);
                        break;
                    }case 'script':case 'scripts':{
                        echo script_tag($element);
                        break;
                    }default:{
                        echo link_tag($element);
                    }
                }
            }
        }
        ?>
    </head>
    <body>