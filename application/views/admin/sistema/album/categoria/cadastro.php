<?php $this->load->view('templates/alertas'); 
// Declaração de arrays de inputs , labels e hiddens.
$hidden['idcategoria'] = set_value('idcategoria',$idcategoria);
$field['nome'] = array(
    'input' => array('name'=>'nome','placeholder'=>'Nome da Categoria','value'=>set_value('nome',$nome),'required'=>''),
    'label' => 'Nome Categoria'
);
$field['sobcategoria'] = array(
    'dropdown' => array('name'=>'idsobcategoria','placeholder'=>'Subcategoria de...'),
    'label' => 'Subcategoria de',
    'options' => $sobcategorias,
    'selected' => set_value('idsobcategoria',$idsobcategoria)
);
?>
<div class="row">
    <div class="medium-12 medium-centered column">
        <?= form_open('admin/sistema/album/categoria/salvar','',$hidden); ?>
            <?php 
            $ferramentas['title'] = 'Cadastro de Categoria';
            $ferramentas['limpar'] = TRUE;
            $ferramentas['salvar'] = TRUE;
            $ferramentas['adicionar'] = array('href'=>'admin/sistema/album/categoria/cadastro');
            $ferramentas['buscar'] = array('href'=>'admin/sistema/album/categoria/busca');
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
                        <?= get_form_field($field['sobcategoria']);?>
                    </div>
                </div>
            </div>
    </div>
</div>