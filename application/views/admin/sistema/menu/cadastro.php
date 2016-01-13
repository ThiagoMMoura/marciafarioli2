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
$datalist['grupo'] = array('options'=>$grupos,'id'=>'grupos');
$input['tipo'] = array('name'=>'tipo','placeholder'=>'Selecione um tipo');
$label['tipo'] = 'Tipo';
$options['tipo'] = $tipos;
$selected['tipo'] = set_value('tipo',$tipo);
$input['formato'] = array('name'=>'formato','placeholder'=>'Selecione um formato');
$label['formato'] = 'Formato';
$options['formato'] = $formatos;
$selected['formato'] = set_value('formato',$formato);
$input['permissao'] = array('name'=>'permissao','placeholder'=>'Selecione uma permissao');
$label['permissao'] = 'Permissao';
$options['permissao'] = $permissoes;
$selected['permissao'] = set_value('permissao',$permissao);
$input['idmenupai'] = array('name'=>'idmenupai','placeholder'=>'Selecione um menu para ser pai');
$label['idmenupai'] = 'Menu Pai';
$options['idmenupai'] = $menus;
$selected['idmenupai'] = set_value('idmenupai',$idmenupai);
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
                            <div class="small-11 columns">
                                <?= form_input($input['grupo']) . form_datalist($datalist['grupo']);?>
                            </div>
                            <div class="small-1 columns">
                                <a href="#" data-dropdown="drop-grupos" class="button dropdown postfix" style="padding-right: 2rem;"></a>
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
                <div class="medium-6 columns">
                    <label><?= $label['tipo'].form_dropdown($input['tipo'], $options['tipo'], $selected['tipo']);?></label>
                    <?= form_error($input['tipo']['name']);?>
                </div>
            </div>
            <div class="row">
                <div class="medium-6 columns">
                    <label><?= $label['formato'].form_dropdown($input['formato'], $options['formato'], $selected['formato']);?></label>
                    <?= form_error($input['formato']['name']);?>
                </div>
                <div class="medium-6 columns">
                    <label><?= $label['permissao'].form_dropdown($input['permissao'], $options['permissao'], $selected['permissao']);?></label>
                    <?= form_error($input['permissao']['name']);?>
                </div>
            </div>
            <div class="row">
                <div class="medium-12 columns">
                    <label><?= $label['idmenupai'].form_dropdown($input['idmenupai'], $options['idmenupai'], $selected['idmenupai']);?></label>
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


