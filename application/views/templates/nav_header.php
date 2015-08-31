<div class="row nav-header">
    <div class="small-12 small-centered columns">
        <div id="logo-topo" class="text-center">
        	<a href="<?php echo base_url(); ?>">
            	<img src="<?php echo SITEURL.'/'.IMAGES_PATH ?>/site/logo/marcia_farioli.png" />
            </a>
        </div>
    </div>
    <div class="small-12 columns">
    	<?php $botoes = array('Home'=>'home','Fotografia'=>'fotografia','Filmes'=>'filmes','Casa de Eventos'=>'casa_de_eventos','Blog'=>'blog');?>
    	<ul class="button-group even-<?php echo count($botoes);?>">
            <?php foreach($botoes as $botao => $end){?>
            	<?php echo (($page==$end)?'<li class="nav-active">':'<li>');
				 echo anchor($end,$botao,array('class' => 'button transparente','active'=>''));
				?></li>
            <?php } ?>
        </ul>
    </div>
</div>
