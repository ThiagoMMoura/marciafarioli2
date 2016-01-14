<? $this->load->view('templates/alertas'); ?>
<div class="row">
    <h2 class="text-center">Níveis de Permissão</h2>
</div>
<div class="row">
    <div class="medium-12 medium-centered column">
        <table class="hover">
            <thead>
                <tr>
                    <th width="150">Nome</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <? 
                foreach($niveis as $nivel){ ?>
                    <tr>
                        <td><?=$nivel['nome'];?></td>
                        <td><?=$nivel['descricao'];?></td>
                        <td>
                            <?if($nivel['id']==$this->config->item('nivelusuariopadrao')){
                                if($this->session->idnivel==$nivel['id']){
                                    echo anchor('admin/usuario/nivel/editar/' . $nivel['id'], 'Editar');
                                }
                            }else{
                                if($this->menu_model->hasPermissao($this->config->item('admin-usuario-nivel-cadastro'))){
                                    echo anchor('admin/usuario/nivel/editar/' . $nivel['id'], 'Editar');
                                }
                            }?>
                        </td>
                    </tr>
                <? } ?>
            </tbody>
        </table>
    </div>
</div>