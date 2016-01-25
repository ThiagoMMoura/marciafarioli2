<? $this->load->view('templates/alertas'); ?>
<div class="row">
    <h2 class="text-center">URLs</h2>
</div>
<div class="row">
    <div class="medium-12 medium-centered column">
        <table class="hover">
            <thead>
                <tr>
                    <th width="150">Nome</th>
                    <th>Descrição</th>
                    <th>URL</th>
                    <th>Restrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($urls as $url){ ?>
                    <tr>
                        <td><?=$url['nome'];?></td>
                        <td><?=$url['descricao'];?></td>
                        <td><?=$url['url'];?></td>
                        <td><?php $is_restrict = FALSE;
                        foreach($urls_restritas as $res){
                            if($res === 'admin/sistema/url/restringir'){
                                $is_restrict = TRUE;
                                break;
                            }
                        } 
                        if($is_restrict){
                            echo $url['restricao']?'Sim':'Não';
                        }else{
                            echo anchor('admin/sistema/url/restringir/'.$url['id'], $url['restricao']?'Sim':'Não');
                        }
                        ?></td>
                        <td><?= anchor('admin/sistema/url/editar/' . $url['id'], 'Editar');?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>