<?php $this->load->view('templates/alertas'); 
// Declaração de arrays de inputs, labels e hiddens.
$hidden['idnivel'] = set_value('idnivel',$idnivel);
$hidden['ordem'] = set_value('ordem',$ordem);
$input['nome'] = array('name'=>'nome','placeholder'=>'Nome do nível','value'=>set_value('nome',$nome),'required'=>'');
$label['nome'] = 'Nome Nível';
$input['hierarquia'] = array('name'=>'hierarquia','value'=>set_value('hierarquia',$hierarquia),'type'=>'number','required'=>'','max'=>100,'min'=>$hierarquia_min);
$label['hierarquia'] = 'Hierarquia';
$input['descricao'] = array('name'=>'descricao','placeholder'=>'Descreva as funções do nível...','value'=>set_value('descricao',$descricao),'type'=>'textarea','rows'=>4,'cols'=>300);
$label['descricao'] = 'Descrição';
?>
<div class="row">
    <h2 class="text-center">Cadastro de Níveis</h2>
</div>
<div class="row">
    <div class="medium-12 medium-centered column">
        <?= form_open('admin/usuario/nivel/salvar','',$hidden); ?>
            <div class="row">
                <div class="medium-8 large-10 columns">
                    <?= get_form_field($input['nome'],$label['nome']);?>
                </div>
                <div class="medium-4 large-2 columns">
                    <?= get_form_field($input['hierarquia'],$label['hierarquia']);?>
                </div>
            </div>
            <div class="row">
                <div class="medium-12 columns">
                    <?= get_form_field($input['descricao'],$label['descricao']);?>
                </div>
            </div>
        <div class="row">
            <div class="medium-12 column">
                
                <table>
                    <thead>
                        <tr class="text-center">
                            <th>Grupo</th>
                            <th>Menu</th>
                            <th>Consultar</th>
                            <th>Incluir</th>
                            <th>Editar</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($menus as $row){?>
                            <tr>
                                <?php $perm = array('id'=>'','consultar'=>FALSE,'incluir'=>FALSE,'editar'=>FALSE,'excluir'=>FALSE); //Valores Padrão

                                foreach($permissoes as $permissao){
                                    if($permissao['idmenu']==$row['id']){
                                        $perm = $permissao;
                                    }
                                }?>
                                <?= form_hidden('idpermissao'.$row['id'], $perm['id']);?>
                                <?= form_hidden('idmenu[]', $row['id'])?>
                                <td><?= $row['grupo'];?></td>
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


