<? $this->load->view('templates/alertas'); ?>
<div class="row">
    <div class="medium-12 medium-centered column">
        <?php
        $ferramentas['title'] = 'Busca de URL';
        $ferramentas['adicionar'] = array('href'=>'admin/sistema/url/cadastro');
        $this->load->view('templates/barra_ferramentas',$ferramentas);
        ?>
        <div class="panel">
            <?php if(isset($urls) && !empty($urls)){?>
                <table class="hover">
                    <thead>
                        <tr>
                            <th width="164">Nome</th>
                            <th width="350" class="visible-for-medium-up">Descrição</th>
                            <th width="250">URL</th>
                            <th width="100">Restrição</th>
                            <th width="64px">Ações</th>
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
                                <td><?php 
                                if(array_search('admin/sistema/url/editar', $urls_restritas)===FALSE){
                                    echo anchor('admin/sistema/url/editar/' . $url['id'], 'Editar');
                                }
                                ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php }else{
                $data['warning'] = $this->lang->line('warning_no_registration_found');
                $this->load->view('templates/alertas',$data);
            }?>
        </div><!-- Fim do Painel -->
    </div>
</div>