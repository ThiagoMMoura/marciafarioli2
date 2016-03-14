<? $this->load->view('templates/alertas'); ?>

<div class="row">
    <div class="medium-12 medium-centered column">
        <?php
        $ferramentas['title'] = 'Busca de Categorias de Albuns';
        $ferramentas['adicionar'] = array('href'=>'admin/sistema/album/categoria/cadastro');
        $this->load->view('templates/barra_ferramentas',$ferramentas);
        ?>
        <div class="panel">
            <?php
            if(isset($categorias) && !empty($categorias)){?>
                <table>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Sob Categoria</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($categorias as $categoria){?>
                        <?php 
                        $categoria['sobcategoria'] = ' - ';
                        foreach($categorias as $sob){
                            if($sob['id']===$categoria['idsobcategoria']){
                                $categoria['sobcategoria'] = $sob['id'] . ' - ' . $sob['nome'];
                                break;
                            }
                        }
                        ?>
                        <tr id="<?= $categoria['id'];?>">
                            <td><?= $categoria['nome'];?></td>
                            <td><?= $categoria['sobcategoria'];?></td>
                            <td >
                                <?= anchor('admin/sistema/album/categoria/editar/' . $categoria['id'], '<i class="fi-pencil"></i>');?>
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

