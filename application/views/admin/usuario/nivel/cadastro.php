<? $this->load->view('templates/alertas'); ?>
<div class="row">
    <h2 class="text-center">Cadastro de Níveis</h2>
</div>
<div class="row">
    <div class="medium-12 medium-centered column">
        <?= validation_errors(); ?>
        <?= form_open('admin/usuario/nivel/salvar'); ?>
            <?
            $form_id = array('name'=>'idnivel','value'=>set_value('idnivel'),'type'=>'hidden','readonly'=>'');
            form_input($form_id,'');?>
            <div class="row">
                <div class="medium-12 columns">
                    <?php
                    $form_nome = array('name'=>'nome','placeholder'=>'Nome do nível','value'=>set_value('nome'),'required'=>'');
                    $atributos = array();
                    if (form_error('nome') != NULL) {
                        $atributos['class'] = isset($atributos['class']) ? $atributos['class'] . ' error' : 'error';
                    }
                    echo form_label('Nome Nível'.form_input($form_nome,''),'',$atributos);
                    echo form_error('nome');
                  ?>
                </div>
            </div>
            <div class="row">
                <div class="medium-12 columns">
                    <?php
                    $form_descricao = array('name'=>'descricao','placeholder'=>'Descreva as funções do nível...','value'=>set_value('descricao'),'rows'=>4,'cols'=>300,'required'=>'');
                    $atributos = array();
                    if (form_error('nome') != NULL) {
                        $atributos['class'] = isset($atributos['class']) ? $atributos['class'] . ' error' : 'error';
                    }
                    echo form_label('Descrição'.form_textarea($form_descricao,''),'',$atributos);
                    echo form_error('nome');
                  ?>
                </div>
            </div>
        <div class="row">
            <div class="medium-12 column">
                <? if(isset($idnivel)){ 
                    $options = $this->menu_model->getOptionsArray('nome','sistema = 1','nome ASC');?>
                    <table>
                        <thead class="text-center">
                            <tr>
                                <th>Menu</th>
                                <th>Consultar</th>
                                <th>Incluir</th>
                                <th>Editar</th>
                                <th>Excluir</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?$atributos = array('name'=>'menu[]')?>
                            <?foreach($permissoes as $row){?>
                                <tr>
                                    <td><?= form_dropdown($atributos, $options,$row['idmenu'])?> </td>
                                    <td><?=  form_checkbox(array('name'=>'consultar[]','checked'=>$row['consultar']));?></td>
                                    <td><?=  form_checkbox(array('name'=>'incluir[]','checked'=>$row['incluir']));?></td>
                                    <td><?=  form_checkbox(array('name'=>'editar[]','checked'=>$row['editar']));?></td>
                                    <td><?=  form_checkbox(array('name'=>'excluir[]','checked'=>$row['excluir']));?></td>
                                </tr>
                            <? } ?>
                            <tr>
                                <td><?= form_dropdown($atributos, $options)?> </td>
                                <td><?=  form_checkbox(array('name'=>'consultar[]'));?></td>
                                <td><?=  form_checkbox(array('name'=>'incluir[]'));?></td>
                                <td><?=  form_checkbox(array('name'=>'editar[]'));?></td>
                                <td><?=  form_checkbox(array('name'=>'excluir[]'));?></td>
                            </tr>
                        </tbody>
                    </table>
                <? } else {?>
                    <p>Salve o registro para adicionar permissões.</p>
                <? } ?>
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


