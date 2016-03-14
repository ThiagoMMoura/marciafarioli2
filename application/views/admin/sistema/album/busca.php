<? $this->load->view('templates/alertas'); ?>

<div class="row">
    <div class="medium-12 medium-centered column">
        <?php
        $ferramentas['title'] = 'Busca de Albuns';
        $ferramentas['adicionar'] = array('href'=>'admin/sistema/album/cadastro');
        $this->load->view('templates/barra_ferramentas',$ferramentas);
        ?>
        <div class="panel">
            <?php
            if(isset($albuns) && !empty($albuns)){?>
                <table>
                    <thead>
                        <tr>
                            <th class="visible-for-medium-up">Capa</th>
                            <th>Nome</th>
                            <th class="visible-for-medium-up">Descrição</th>
                            <th>Biblioteca</th>
                            <th>Classificação</th>
                            <th>Criado em</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($albuns as $album){?>
                        <tr id="<?= $album['id'];?>">
                            <td class="visible-for-medium-up" ><?= $album['idcapa'];?></td>
                            <td><?= $album['nome'];?></td>
                            <td class="visible-for-medium-up" ><?= $album['descricao'];?></td>
                            <td><?= $album['biblioteca'];?></td>
                            <td><?= $album['classificacao'];?></td>
                            <td><?= nice_date($album['criado'],'d/m/Y (h:i a)');?></td>
                            <td >
                                <?= anchor('admin/sistema/album/editar/' . $album['id'], '<i class="fi-pencil"></i>');?>
                            </td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            <?php }else{
                $data['warning'] = $this->lang->line('warning_no_registration_found');
                $this->load->view('templates/alertas',$data);
            }?>
        </div>
    </div>
</div>

