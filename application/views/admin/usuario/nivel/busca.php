<? $this->load->view('templates/alertas'); ?>
<div class="row">
    <div class="medium-12 medium-centered column">
        <?php
        $ferramentas['title'] = 'Busca Níveis de Usuário';
        $ferramentas['adicionar'] = array('href'=>'admin/usuario/nivel/cadastro');
        $this->load->view('templates/barra_ferramentas',$ferramentas);
        ?>
        <div class="panel">
            <?php
            if(isset($niveis) && !empty($niveis)){?>
                <table class="hover">
                    <thead>
                        <tr>
                            <th>Hierarquia</th>
                            <th width="200px">Nome</th>
                            <th width="500px">Descrição</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <? 
                        foreach($niveis as $nivel){ ?>
                            <tr>
                                <td><?=$nivel['hierarquia'];?></td>
                                <td><?=$nivel['nome'];?></td>
                                <td><?=$nivel['descricao'];?></td>
                                <td>
                                    <?if($nivel_usuario==$this->config->item('nivel-master') OR $hierarquia_usuario < $this->usuario_model->get_hierarquia($nivel['id'])){
                                        echo anchor('admin/usuario/nivel/editar/' . $nivel['id'], 'Editar');
                                    }?>
                                </td>
                            </tr>
                        <? } ?>
                    </tbody>
                </table>
            <?php }else{
                $data['warning'] = $this->lang->line('warning_no_registration_found');
                $this->load->view('templates/alertas',$data);
            }?>
        </div>
    </div>
</div>