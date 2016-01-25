<?php $this->load->view('templates/alertas'); 
// Declaração de arrays de inputs, labels e hiddens.
$hidden['id'] = set_value('id',$id);
$field['nome'] = array(
    'input' => array('name'=>'nome','placeholder'=>'Nome para identificar a URL','value'=>set_value('nome',$nome),'required'=>''),
    'label' => 'Nome Nível'
);
$field['descricao'] = array(
    'textarea' => array('name'=>'descricao','placeholder'=>'Descreva a função da URL...','value'=>set_value('descricao',$descricao),'rows'=>4,'cols'=>300),
    'label' => 'Descrição'
);
$field['url'] = array(
    'input' => array('name'=>'url','placeholder'=>'Digite uma URL...','value'=>set_value('url',$url),'required'=>''),
    'label' => 'URL'
);
$field['restricao'] = array(
    'checkbox' => array('name'=>'restricao','value'=>'restrito','checked'=>  set_value('restricao', $restricao)),
    'label'=> 'Restringir acesso'
);
?>
<div class="row">
    <h2 class="text-center">Cadastro de URLs</h2>
</div>
<div class="row">
    <div class="medium-12 medium-centered column">
        <?= form_open('admin/sistema/url/salvar','',$hidden); ?>
            <div class="row">
                <div class="medium-12 columns">
                    <?= get_form_field($field['nome']);?>
                </div>
            </div>
            <div class="row">
                <div class="medium-12 columns">
                    <?= get_form_field($field['descricao']);?>
                </div>
            </div>
            <div class="row">
                <div class="medium-12 columns">
                    <?= get_form_field($field['urç']);?>
                </div>
            </div>
            <div class="row">
                <div class="medium-12 columns">
                    <?= get_form_field($field['restricao']);?>
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


