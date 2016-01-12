<?php $this->load->view('templates/alertas'); 
// Declaração de arrays de inputs , labels e hiddens.
$hidden = array('idmenu'=>set_value('idmenu',$idmenu));
$input['nome'] = array('name'=>'nome','placeholder'=>'Nome do menu','value'=>set_value('nome',$nome),'required'=>'');
$label['nome'] = 'Nome Menu';
$input['descricao'] = array('name'=>'descricao','placeholder'=>'Descreva a função do menu...','value'=>set_value('descricao',$descricao),'rows'=>4,'cols'=>300);
$label['descricao'] = 'Descrição';
$input['url'] = array('name'=>'url','placeholder'=>'URL do menu','value'=>set_value('url',$url));
$label['url'] = 'URL';
$input['grupo'] = array('name'=>'grupo','id'=>'grupo','placeholder'=>'Selecione ou digite um novo Grupo','value'=>set_value('grupo',$grupo),'list'=>'grupos');
$label['grupo'] = 'Grupo';
$datalist['grupo'] = array('options'=>$grupos)
?>
<div class="row">
    <h2 class="text-center">Cadastro de Níveis</h2>
</div>
<div class="row">
    <div class="medium-12 medium-centered column">
        <?= form_open('admin/sistema/menu/salvar','',$hidden); ?>
            <div class="row">
                <div class="medium-12 columns">
                    <?= get_form_field($input['nome'],$label['nome']);?>
                </div>
            </div>
            <div class="row">
                <div class="medium-12 columns">
                    <?= get_form_field($input['descricao'],$label['descricao']);?>
                </div>
            </div>
            <div class="row">
                <div class="medium-12 columns">
                    <?= get_form_field($input['url'],$label['url']);?>
                </div>
            </div>
            <div class="row">
                <div class="medium-6 columns">
                    <label><?= $label['grupo']; ?>
                        <div class="row collapse">
                            <div class="small-10 columns">
                                <?= form_input($input['grupo']);?>
                            </div>
                            <div class="small-2 columns">
                                <a href="#" data-dropdown="drop-grupos" class="button postfix">&raquo;</a>
                            </div>
                            <div class="small-12 columns">
                                <ul id="drop-grupos" class="large f-dropdown" data-dropdown-content>
                                    <?php foreach($grupos as $key => $gru){ ?>
                                        <li><a onclick='<?= 'javascript:document.getElementById("'.$input['grupo']['id'].'").value = "'.$key.'"';?>'><?= $gru; ?></a></li>
                                    <?php }?>
                                </ul>
                            </div>
                        </div>
                        <?= form_error($input['grupo']['name']);?>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="medium-2 medium-centered columns">
                    <?= form_submit('salvar', 'Salvar', 'class="button expand"'); ?>
                </div>
            </div>
        <?= form_close(); ?>
    </div>
</div>


