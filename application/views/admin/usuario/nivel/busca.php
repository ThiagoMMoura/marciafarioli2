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
                <? $this->nivel_model->selecionar('*',NULL,'nome');
                foreach($this->nivel_model->getResultados() as $nivel){ ?>
                    <tr>
                        <td><?=$nivel->nome;?></td>
                        <td><?=$nivel->descricao;?></td>
                        <td>
                            <?if($nivel->getId()==$this->config->item('nivelusuariopadrao')){
                                if($this->session->idnivel==$nivel->getId()){
                                    echo anchor('admin/usuario/nivel/editar/' . $nivel->getId(), 'Editar');
                                }
                            }else{
                                if($this->menu_model->hasPermissao($this->config->item('admin-usuario-nivel-cadastro'))){
                                    echo anchor('admin/usuario/nivel/editar/' . $nivel->getId(), 'Editar');
                                }
                            }?>
                        </td>
                    </tr>
                <? } ?>
            </tbody>
        </table>
    </div>
</div>