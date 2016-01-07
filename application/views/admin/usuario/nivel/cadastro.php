<?php $this->load->view('templates/alertas'); ?>
<div class="row">
    <h2 class="text-center">Cadastro de Níveis</h2>
</div>
<div class="row">
    <div class="medium-12 medium-centered column">
        <?= form_open('admin/usuario/nivel/salvar'); ?>
            <?php
            $form_id = array('name'=>'idnivel','value'=>set_value('idnivel',isset($idnivel)?$idnivel:''),'type'=>'hidden','readonly'=>'');
            echo form_input($form_id);?>
            <div class="row">
                <div class="medium-12 columns">
                    <?php
                    $form_nome = array('name'=>'nome','placeholder'=>'Nome do nível','value'=>set_value('nome',isset($nome)?$nome:''),'required'=>'');
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
                    $form_descricao = array('name'=>'descricao','placeholder'=>'Descreva as funções do nível...','value'=>set_value('descricao',isset($descricao)?$descricao:''),'rows'=>4,'cols'=>300);
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
            <div class="medium-12 column">
                
                <table>
                    <thead>
                        <tr class="text-center">
                            <th>Menu</th>
                            <th>Consultar</th>
                            <th>Incluir</th>
                            <th>Editar</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $menus = $this->menu_model->selecionar('id,nome','sistema = 1','grupo ASC, nome ASC'); ?>
                        <?php foreach($menus as $row){?>
                            <tr>
                                <?php $perm = array('id'=>'','consultar'=>FALSE,'incluir'=>FALSE,'editar'=>FALSE,'excluir'=>FALSE); //Valores Padrão
                                if(isset($permissoes)){
                                    foreach($permissoes as $permissao){
                                        if($permissao['idmenu']==$row['id']){
                                            $perm = $permissao;
                                        }
                                    }
                                }?>
                                <?= form_hidden('idpermissao'.$row['id'], $perm['id']);?>
                                <?= form_hidden('idmenu[]', $row['id'])?>
                                <td><?= $row['nome'];?></td>
                                <td><?= form_hidden('consultar'.$row['id'],0) . form_checkbox(array('name'=>'consultar'.$row['id'],'checked'=>$perm['consultar'],'value'=>1));?></td>
                                <td><?= form_hidden('incluir'.$row['id'],0)   . form_checkbox(array('name'=>'incluir'.$row['id'],'checked'=>$perm['incluir'],'value'=>1));?></td>
                                <td><?= form_hidden('editar'.$row['id'],0)    . form_checkbox(array('name'=>'editar'.$row['id'],'checked'=>$perm['editar'],'value'=>1));?></td>
                                <td><?= form_hidden('excluir'.$row['id'],0)   . form_checkbox(array('name'=>'excluir'.$row['id'],'checked'=>$perm['excluir'],'value'=>1));?></td>
                            </tr>
                        <?php } ?>
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


