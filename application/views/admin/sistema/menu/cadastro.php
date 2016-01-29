<?php $this->load->view('templates/alertas'); 
// Declaração de arrays de inputs , labels e hiddens.
$hidden['idmenu'] = set_value('idmenu',$idmenu);
$hidden['ordem'] = set_value('ordem',$ordem);
$field['nome'] = array(
    'input' => array('name'=>'nome','placeholder'=>'Nome do menu','value'=>set_value('nome',$nome),'required'=>''),
    'label' => 'Nome Menu'
);
$field['icone'] = array(
    'input' => array('name'=>'icone','value'=>set_value('icone',$icone),'id'=>'icone','type'=>'hidden')
);
$field['descricao'] = array(
    'textarea' => array('name'=>'descricao','placeholder'=>'Descreva a função do menu...','value'=>set_value('descricao',$descricao),'rows'=>4,'cols'=>300),
    'label' => 'Descrição'
);
$field['url'] = array(
    'input' => array('name'=>'url','placeholder'=>'URL do menu','value'=>set_value('url',$url),'list'=>'urls'),
    'label' => 'URL',
    'datalist' => 'urls',
    'options' => $urls
);
$input['grupo'] = array('name'=>'grupo','id'=>'grupo','placeholder'=>'Selecione ou digite um novo Grupo','value'=>set_value('grupo',$grupo),'list'=>'grupos','required'=>'');
$label['grupo'] = 'Grupo';
$datalist['grupo'] = array('options'=>$grupos,'id'=>'grupos');

$field['tipo'] = array(
    'dropdown' => array('name'=>'tipo','placeholder'=>'Selecione um tipo'),
    'label' => 'Tipo',
    'options' => $tipos,
    'selected' => set_value('tipo',$tipo)
);

$field['formato'] = array(
    'dropdown' => array('name'=>'formato','placeholder'=>'Selecione um formato'),
    'label' => 'Formato',
    'options' => $formatos,
    'selected' => set_value('formato',$formato)
);
$menus[0] = 'Nenhum';
$field['idmenupai'] = array(
    'dropdown' => array('name'=>'idmenupai','placeholder'=>'Selecione um menu para ser pai'),
    'label' => 'Menu Pai',
    'options' => $menus,
    'selected' => set_value('idmenupai',$idmenupai)
);

?>
<script type="text/javascript">
    function seleciona_icone(icone){
        $('#<?=$field['icone']['input']['id'];?>').val(icone);
        $('#prefix-icone').removeClass().addClass(icone);
        $('#popup-selecionar-icone').foundation('reveal', 'close');
    }
</script>
<?php /*Pop-up para selecionar icone do menu*/ ?>
<div id="popup-selecionar-icone" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
    <h2 id="modalTitle">Selecione um Icone</h2>
    <ul class="small-block-grid-8 medium-block-grid-10 large-block-grid-12">
        <?php
        foreach($icones as $key => $ic){?>
            <li class="text-center"><a onclick='seleciona_icone("<?=  $key; ?>")'><?= $ic; ?></a></li>
        <?php } ?>
    </ul>
    <a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>
<?php /*Inicio Formulário de cadastro para menus do sistema*/ ?>
<div class="row">
    <div class="medium-12 medium-centered column">
        <?= form_open('admin/sistema/menu/salvar','',$hidden); ?>
            <?php 
            $ferramentas['title'] = $title;
            $ferramentas['limpar'] = TRUE;
            $ferramentas['salvar'] = TRUE;
            $ferramentas['adicionar'] = array('href'=>'admin/sistema/menu/cadastro');
            $ferramentas['buscar'] = array('href'=>'admin/sistema/menu/busca');
            $this->load->view('templates/barra_ferramentas',$ferramentas);
            ?>
            <div class="panel">
                <div class="row">
                    <div class="small-12 medium-8 large-10 columns">
                        <?= get_form_field($field['nome']);?>
                    </div>
                    <div class="small-12 medium-4 large-2 columns">
                        <label>Icone
                            <div class="row collapse">
                                <div class="small-4 columns">
                                    <span class="prefix"><i id="prefix-icone" class='<?= set_value('icone',$icone); ?>'></i></span>
                                </div>
                                <div class="small-8 columns">
                                    <?= get_form_field($field['icone']);?>
                                    <a class="button prefix" data-reveal-id="popup-selecionar-icone">Selecionar</a>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-12 columns">
                        <?= get_form_field($field['descricao']);?>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-12 columns">
                        <?= get_form_field($field['url']);?>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-6 columns">
                        <label <?= form_error($input['grupo']['name'])!=NULL?'class="error"':'';?>><?= $label['grupo']; ?>
                            <div class="row collapse">
                                <div class="small-10 columns">
                                    <?= form_input($input['grupo']) . form_datalist($datalist['grupo']);?>
                                </div>
                                <div class="small-2 columns">
                                    <a href="#" data-dropdown="drop-grupos" class="button dropdown postfix" style="padding-right: 1.9rem;"></a>
                                </div>
                                <div class="small-12 columns">
                                    <ul id="drop-grupos" class="large f-dropdown" data-dropdown-content>
                                        <?php foreach($grupos as $key => $gru){ ?>
                                            <li><a onclick='<?= 'javascript:document.getElementById("'.$input['grupo']['id'].'").value = "'.$key.'"';?>'><?= $gru; ?></a></li>
                                        <?php }?>
                                    </ul>
                                </div>
                            </div>
                        </label>
                        <?= form_error($input['grupo']['name']);?>
                    </div>
                    <div class="medium-6 columns">
                        <?= get_form_field($field['tipo']);?>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-6 columns">
                        <?= get_form_field($field['formato']);?>
                    </div>
                    <div class="medium-6 columns">
                        <?= get_form_field($field['idmenupai']);?>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-2 medium-centered columns">
                        <?= form_submit('salvar', 'Salvar', 'class="button expand"'); ?>
                    </div>
                </div>
            </div>
        <?= form_close(); ?>
    </div>
</div>