<div class="row">
    <div class="small-12 small-centered columns">
        <div id="logo-topo" class="text-center">
        	<a href="<?php echo base_url(); ?>">
            	<img src="<?php echo SITEURL.'/'.IMAGES_PATH ?>/site/logo/marcia_farioli.png" />
            </a>
        </div>
    </div>
    <div class="small-12 columns">
    	<?php $botoes = array('Fotografia'=>'fotografia','Filmes'=>'filmes','Casa de Eventos'=>'casa_de_eventos','Gastronomia'=>'gastronomia');?>
    	<ul class="button-group even-4">
            <?php foreach($botoes as $botao => $end){?>
            	<li><?php echo anchor($end,$botao,array('class' => 'button transparente'));?></li>
            <?php } ?>
        </ul>
    </div>
</div>
