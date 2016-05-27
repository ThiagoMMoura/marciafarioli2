<?php $this->load->view('templates/alertas'); 
$field['userfile'] = array(
    'input' => array('name'=>'userfile','type'=>'file','size'=>'50','id'=>'userfile','onchange'=>'upload()'),
    'label' => ''
);
?>

<div class="row">
    <div class="medium-12 medium-centered column">
        <?php
        $ferramentas['title'] = 'Album de Fotos - Portfolio';
        $ferramentas['adicionar'] = array('href'=>'admin/sistema/album/cadastro');
        $ferramentas['buscar'] = array('href'=>'admin/site/portfolio/albuns');
        $this->load->view('templates/barra_ferramentas',$ferramentas);
        ?>
        <div class="panel">
            <div class="row">
                <div class="medium-12 columns">
                    <?= $album['nome'];?>
                    <ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-4">
                        <?php foreach ($fotos as $foto){ ?>
                            <li><?= img($foto['url']);?></li>
                        <?php } ?>
                        <li>
                            <div class="imagem-upload-box background-load-img text-center">
                                <?= img("images/site/adicionar/add.png",FALSE,'class="img-padrao"');?>
                                <?= get_form_field($field['userfile']);?>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            
        </div>
    </div>
</div>

