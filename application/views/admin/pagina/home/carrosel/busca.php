<?php $this->load->view('templates/alertas'); 
$this->load->helper('directory');
?>
<div class="row">
    <div class="small-12 columns text-center">
        <?php echo heading('Imagens do carrosel',2);?>
    </div>
</div>
<div class="row">
    <div class="carrosel-lista">
    	<ul class="small-block-grid-1 medium-block-grid-3 large-block-grid-5">
            <?php
            $pasta = './images/site/carrosel/';
            $map = directory_map($pasta,1);
                if(empty($map)) {
                    echo '<p>Nenhuma imagem encontrada.</p>';
                }else{
                    foreach($map as $img){ ?>
                        <li>
                            <?= img($pasta.$img) . anchor('admin/carrosel/excluir/'.$img,'Excluir');?>
                        </li>
                <?php } ?>
            <?php }?>
        </ul>
    </div>
</div>

