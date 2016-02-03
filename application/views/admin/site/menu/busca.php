<? $this->load->view('templates/alertas'); ?>
<div class="row">
    <div class="medium-12 medium-centered column">
        <?php
        $ferramentas['title'] = 'Busca de Menu';
        $ferramentas['adicionar'] = array('href'=>'admin/site/menu/cadastro');
        $this->load->view('templates/barra_ferramentas',$ferramentas);
        ?>
        <div class="panel">
            <?php
            if(isset($menus) && !empty($menus)){?>
                <table>
                    <thead>
                        <tr>
                            <th>Grupo</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Menu Pai</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($menus as $menu){?>
                        <tr>
                            <td><?= $menu['grupo'];?></td>
                            <td><?= $menu['nome'];?></td>
                            <td><?= $menu['descricao'];?></td>
                            <?php 
                            $menupai = " - ";
                            foreach($menus as $pai){
                                if($menu['idmenupai']===$pai['id']){
                                    $menupai = $pai['id'] . ' - ' . $pai['nome'];
                                    break;
                                }
                            }?>
                            <td><?= $menupai;?></td>
                            <td><?= anchor('admin/site/menu/editar/' . $menu['id'], 'Editar');?></td>
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

