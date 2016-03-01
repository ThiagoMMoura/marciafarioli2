<? $this->load->view('templates/alertas'); ?>
<div class="row">
    <div class="medium-12 medium-centered column">
        <?php
        $ferramentas['title'] = 'Busca UsuÁrios';
        $ferramentas['adicionar'] = array('href'=>'admin/usuario/conta/cadastro');
        $this->load->view('templates/barra_ferramentas',$ferramentas);
        ?>
        <div class="panel">
            <?php
            if(isset($usuarios) && !empty($usuarios)){?>
                <table class="hover">
                    <thead>
                        <tr>
                            <th><i class="fi-male-female"></i></th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Nível</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($usuarios as $usuario){?>
                            <tr>
                                <td><i class="fi-<?=$usuario['sexo']=='Feminino'?'female':'male';?>"></i></td>
                                <td><?=$usuario['nome'];?></td>
                                <td><?=$usuario['email'];?></td>
                                <td><?=$usuario['idnivel'];?></td>
                                <td><?= anchor('admin/usuario/conta/editar/' . $usuario['id'], '<i class="fi-pencil"></i>');?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php }else{
                $data['warning'] = $this->lang->line('warning_no_registration_found');
                $this->load->view('templates/alertas',$data);
            }?>
        </div>
    </div>
</div>

