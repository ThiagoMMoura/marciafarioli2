<?php $this->load->view('templates/alertas'); 
// Declaração de arrays de inputs, labels e hiddens.
$hidden['idnivel'] = set_value('idnivel',$idnivel);
$field['nome'] = array(
    'input' => array('name'=>'nome','placeholder'=>'Nome do nível','value'=>set_value('nome',$nome),'required'=>''),
    'label' => 'Nome Nível'
);
$field['hierarquia'] = array(
    'input' => array('name'=>'hierarquia','value'=>set_value('hierarquia',$hierarquia),'type'=>'number','required'=>'','max'=>100,'min'=>$hierarquia_min),
    'label' => 'Hierarquia'
);
$field['descricao'] = array(
    'textarea' => array('name'=>'descricao','placeholder'=>'Descreva as funções do nível...','value'=>set_value('descricao',$descricao),'rows'=>4,'cols'=>300),
    'label' => 'Descrição'
);
?>
<div class="row">
    <h2 class="text-center">Cadastro de Níveis</h2>
</div>
<div class="row">
    <div class="medium-12 medium-centered column">
        <?= form_open('admin/usuario/nivel/salvar','',$hidden); ?>
            <div class="row">
                <div class="medium-8 large-10 columns">
                    <?= get_form_field($field['nome']);?>
                </div>
                <div class="medium-4 large-2 columns">
                    <?= get_form_field($field['hierarquia']);?>
                </div>
            </div>
            <div class="row">
                <div class="medium-12 columns">
                    <?= get_form_field($field['descricao']);?>
                </div>
            </div>
            <?php if(!empty($urls)){ ?>
                <div class="row">
                    <div class="medium-12 column">
                        <table>
                            <thead>
                                <tr class="text-center">
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th>URL</th>
                                    <th>Permissão</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($urls as $row){?>
                                    <tr>
                                        <?php $perm = array('id'=>'','permite'=>FALSE); //Valores Padrão

                                        foreach($permissoes as $permissao){
                                            if($permissao['idurl']==$row['id']){
                                                $perm = $permissao;
                                            }
                                        }?>
                                        <?= form_hidden('idpermissao'.$row['id'], $perm['id']);?>
                                        <?= form_hidden('idurl[]', $row['id'])?>
                                        <td><?= $row['nome'];?></td>
                                        <td><?= $row['descricao'];?></td>
                                        <td><?= $row['url'];?></td>
                                        <td><?= form_hidden('permite'.$row['id'],0) . form_checkbox(array('name'=>'permite'.$row['id'],'checked'=>$perm['permite'],'value'=>1));?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php }else{
                $data['warning'] = 'Nenhuma url restrita encontrada!<br /><small>Cadastre URLs com restrição para editar as permissões aqui.</small>';
                $this->load->view('templates/alertas',$data); 
            } ?>
            <div class="row">
                <div class="medium-2 medium-centered columns">
                    <?= form_submit('salvar', 'Salvar', 'class="button expand"'); ?>
                </div>
            </div>
        <?= form_close(); ?>
    </div>
</div>


