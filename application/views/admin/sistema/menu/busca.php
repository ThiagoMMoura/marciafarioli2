<div class="row">
    <div class="medium-12 medium-centered column">
        <?php
        $ferramentas['title'] = 'Busca de Menu';
        $ferramentas['adicionar'] = array('href'=>'admin/sistema/menu/cadastro');
        $this->load->view('templates/barra_ferramentas',$ferramentas);
        ?>
        <div class="panel">
            <?php
            if(isset($menus)){?>
                <table>
                    <thead>
                        <tr>
                            <th class="visible-for-medium-up" width="164px">Grupo</th>
                            <th width="180px">Nome</th>
                            <th class="visible-for-medium-up" width="340px">Descrição</th>
                            <th width="180px">Menu Pai</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($menus as $menu){?>
                        <tr>
                            <td class="visible-for-medium-up" ><?= $menu['grupo'];?></td>
                            <td><?= $menu['nome'];?></td>
                            <td class="visible-for-medium-up" ><?= $menu['descricao'];?></td>
                            <?php 
                            $menupai = " - ";
                            foreach($menus as $pai){
                                if($menu['idmenupai']===$pai['id']){
                                    $menupai = $pai['id'] . ' - ' . $pai['nome'];
                                    break;
                                }
                            }?>
                            <td><?= $menupai;?></td>
                            <td><?= anchor('admin/sistema/menu/editar/' . $menu['id'], 'Editar');?></td>
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

