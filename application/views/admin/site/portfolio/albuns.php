<? $this->load->view('templates/alertas'); ?>

<div class="row">
    <div class="medium-12 medium-centered column">
        <?php
        $ferramentas['title'] = 'Busca de Albuns de Portfolio';
        $ferramentas['adicionar'] = array('href'=>'admin/sistema/album/cadastro');
        $this->load->view('templates/barra_ferramentas',$ferramentas);
        ?>
        <div class="panel">
            <?php
            if(isset($albuns) && !empty($albuns)){?>
                <table>
                    <thead>
                        <tr>
                            <th class="medium-3 column">Capa</th>
                            <th class="medium-8 column">Titulo/Descrição</th>
                            <th class="medium-1 column">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($albuns as $album){?>
                        <tr>
                            <td class="medium-3 column">
                                <?php if($album['urlcapa'] != NULL){
                                    echo img($album['urlcapa']);
                                }else{
                                    echo img($url_imagem_sem_capa,FALSE,'');
                                } ?>
                            </td>
                            <td class="medium-8 column" style="vertical-align: top;">
                                <div class="table-row text-bold">
                                    <?= $album['nome'];?>
                                </div>
                                <div class="table-row">
                                    <?= $album['descricao'];?>
                                </div>
                            </td>
                            <td class="medium-1 column">
                                <?= anchor('admin/site/portfolio/album/' . $album['id'], '<i class="fi-pencil"></i>');?>
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

