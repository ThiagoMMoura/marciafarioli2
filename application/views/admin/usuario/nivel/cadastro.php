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
            echo form_input($form_id);?>
            <div class="row">
                <div class="medium-12 columns">
                    <?php
                    $form_nome = array('name'=>'nome','placeholder'=>'Nome do nível','value'=>set_value('nome'),'required'=>'');
                    $atributos = array();
                    if (form_error('nome') != NULL) {
                        $atributos['class'] = isset($atributos['class']) ? $atributos['class'] . ' error' : 'error';
                    }
                    echo form_label('Nome Nível'.form_input($form_nome),'',$atributos);
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
                    echo form_label('Descrição'.form_textarea($form_descricao),'',$atributos);
                    echo form_error('nome');
                  ?>
                </div>
            </div>
        <div class="row">
            <div class="medium-12 column">
                
                <table>
                    <thead>
                        <tr class="text-center">
                            <th></th>
                            <th></th>
                            <th>Menu</th>
                            <th>Consultar</th>
                            <th>Incluir</th>
                            <th>Editar</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <? $menus = $this->menu_model->selecionar('id,nome','sistema = 1','nome ASC','grupo'); ?>
                        <? foreach($menus as $row){?>
                            <tr>
                                <? $perm = array();
                                foreach($permissoes as $permissao){
                                    if($permissao['idmenu']==$row['id']){
                                        $perm = $permissao;
                                    }
                                }?>
                                <td><?= form_hidden('idpermissao[]', $perm['id']);?></td>
                                <td><?= form_hidden('idmenu[]', $row['id'])?></td>
                                <td><?= $row['nome'];?></td>
                                <td><?= form_checkbox(array('name'=>'consultar[]','checked'=>$perm['consultar']));?></td>
                                <td><?= form_checkbox(array('name'=>'incluir[]','checked'=>$perm['incluir']));?></td>
                                <td><?= form_checkbox(array('name'=>'editar[]','checked'=>$perm['editar']));?></td>
                                <td><?= form_checkbox(array('name'=>'excluir[]','checked'=>$perm['excluir']));?></td>
                            </tr>
                        <? } ?>
                    </tbody>
                </table>
                
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


