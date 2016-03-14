<?php $this->load->view('templates/alertas'); 
// Declaração de arrays de inputs , labels e hiddens.
$hidden['idalbum'] = set_value('idalbum',$idalbum);
$hidden['idcapa'] = set_value('idcapa',$idcapa);
$hidden['criado'] = set_value('criado',$criado);
$field['nome'] = array(
    'input' => array('name'=>'nome','placeholder'=>'Nome do Album','value'=>set_value('nome',$nome),'required'=>''),
    'label' => 'Nome Album'
);
$field['descricao'] = array(
    'textarea' => array('name'=>'descricao','placeholder'=>'Descreva o conteúdo do album...','value'=>set_value('descricao',$descricao),'rows'=>4,'cols'=>300),
    'label' => 'Descrição'
);
$field['url'] = array(
    'input' => array('name'=>'url','placeholder'=>'URL do album','value'=>set_value('url',$url),'disabled'=>''),
    'label' => 'URL'
);
$field['biblioteca'] = array(
    'dropdown' => array('name'=>'biblioteca','placeholder'=>'Selecione uma biblioteca'),
    'label' => 'Biblioteca',
    'options' => $bibliotecas,
    'selected' => set_value('biblioteca',$biblioteca)
);
$field['classificacao'] = array(
    'dropdown' => array('name'=>'classificacao','placeholder'=>'Selecione uma classificacao'),
    'label' => 'Classificacao',
    'options' => $classificacoes,
    'selected' => set_value('classificacao',$classificacao)
);
$field['categoria'] = array(
    'dropdown' => array('name'=>'idcategoria','placeholder'=>'Selecione uma categoria'),
    'label' => 'Categoria',
    'options' => $categorias,
    'selected' => set_value('idcategoria',$idcategoria)
);
$field['usuario'] = array(
    'dropdown' => array('name'=>'idusuario','placeholder'=>'Selecione um usuario'),
    'label' => 'Usuario',
    'options' => $usuarios,
    'selected' => set_value('idusuario',$idusuario)
);
?>
<div class="row">
    <div class="medium-12 medium-centered column">
        <?= form_open('admin/sistema/album/salvar','',$hidden); ?>
            <?php 
            $ferramentas['title'] = 'Cadastro de Album';
            $ferramentas['limpar'] = TRUE;
            $ferramentas['salvar'] = TRUE;
            $ferramentas['adicionar'] = array('href'=>'admin/sistema/album/cadastro');
            $ferramentas['buscar'] = array('href'=>'admin/sistema/album/busca');
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
                    <div class="medium-6 columns">
                        <?= get_form_field($field['biblioteca']);?>
                    </div>
                    <div class="medium-6 columns">
                        <?= get_form_field($field['classificacao']);?>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-6 columns">
                        <?= get_form_field($field['categoria']);?>
                    </div>
                    <div class="medium-6 columns">
                        <?= get_form_field($field['usuario']);?>
                    </div>
                </div>
            </div>
        <?= form_close(); ?>
    </div>
</div>
