<?php $this->load->view('templates/alertas'); ?>
<div class="row">
    <h2 class="text-center">Cadastro de Níveis</h2>
</div>
<div class="row">
    <div class="medium-12 medium-centered column">
        <?= form_open('admin/sistema/menu/salvar'); ?>
            <?php
            $form_id = array('name'=>'idmenu','value'=>set_value('idmenu',$idmenu),'type'=>'hidden','readonly'=>'');
            echo form_input($form_id);?>
            <div class="row">
                <div class="medium-12 columns">
                    <?php
                    $form_nome = array('name'=>'nome','placeholder'=>'Nome do menu','value'=>set_value('nome',$nome),'required'=>'');
                    $atributos = array();
                    if (form_error('nome') != NULL) {
                        $atributos['class'] = isset($atributos['class']) ? $atributos['class'] . ' error' : 'error';
                    }
                    echo form_label('Nome Menu'.form_input($form_nome),'',$atributos);
                    echo form_error('nome');
                  ?>
                </div>
            </div>
            <div class="row">
                <div class="medium-12 columns">
                    <?php
                    $form_descricao = array('name'=>'descricao','placeholder'=>'Descreva a função do menu...','value'=>set_value('descricao',$descricao),'rows'=>4,'cols'=>300);
                    $atributos = array();
                    if (form_error('descricao') != NULL) {
                        $atributos['class'] = isset($atributos['class']) ? $atributos['class'] . ' error' : 'error';
                    }
                    echo form_label('Descrição'.form_textarea($form_descricao),'',$atributos);
                    echo form_error('descricao');
                  ?>
                </div>
            </div>
            <div class="row">
                <div class="medium-12 columns">
                    <?php
                    $form_url = array('name'=>'url','placeholder'=>'URL do menu','value'=>set_value('url',$url));
                    $atributos = array();
                    if (form_error('url') != NULL) {
                        $atributos['class'] = isset($atributos['class']) ? $atributos['class'] . ' error' : 'error';
                    }
                    echo form_label('URL'.form_input($form_url),'',$atributos);
                    echo form_error('url');
                  ?>
                </div>
            </div>
            <div class="row">
                <div class="medium-12 columns">
                    <?php
                    $form_grupo = array('name'=>'grupo','placeholder'=>'Selecione ou digite um novo Grupo','value'=>set_value('grupo',$grupo));
                    $atributos = array();
                    if (form_error('grupo') != NULL) {
                        $atributos['class'] = isset($atributos['class']) ? $atributos['class'] . ' error' : 'error';
                    }
                    echo form_label('Grupo'.form_input($form_grupo),'',$atributos);
                    echo form_error('grupo');
                  ?>
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


