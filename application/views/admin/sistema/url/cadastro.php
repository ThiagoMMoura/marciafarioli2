<?php $this->load->view('templates/alertas'); 
// Declaração de arrays de inputs, labels e hiddens.
$hidden['id'] = set_value('id',$id);
$field['nome'] = array(
    'input' => array('name'=>'nome','placeholder'=>'Nome para identificar a URL','value'=>set_value('nome',$nome),'required'=>''),
    'label' => 'Nome URL'
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
    'input' => array('name'=>'restricao','id'=>'restricao','value'=>'1','type'=>'checkbox'),
    'label'=> array('text' => 'Restringir acesso','for'=>'restricao','posicao'=>'depois'),
    'extra' => set_value('restricao',$restricao)?'checked':''
);
?>
<div class="row">
    <div class="medium-12 medium-centered column">
        <?= form_open('admin/sistema/url/salvar','',$hidden); ?>
            <?php 
            $ferramentas['title'] = 'Cadastro de URL';
            $ferramentas['limpar'] = TRUE;
            $ferramentas['salvar'] = TRUE;
            $ferramentas['adicionar'] = array('href'=>'admin/sistema/url/cadastro');
            $ferramentas['buscar'] = array('href'=>'admin/sistema/url/busca');
            $this->load->view('templates/barra_ferramentas',$ferramentas);
            ?>
            <div class="panel">
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
                        <?= get_form_field($field['url']);?>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-12 columns">
                        <?= get_form_field($field['restricao']);?>
                    </div>
                </div>
            </div>
        <?= form_close(); ?>
    </div>
</div>


