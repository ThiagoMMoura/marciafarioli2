<?php $this->load->view('templates/alertas'); 
$this->load->helper('directory');
?>
<div class="row">
    <div class="medium-12 medium-centered column">
        <?php
        $ferramentas['title'] = 'Busca Imagens Carrosel';
        $ferramentas['adicionar'] = array('href'=>'admin/pagina/home/carrosel/adicionar');
        $this->load->view('templates/barra_ferramentas',$ferramentas);
        ?>
        <div class="panel">
            <?php
            $pasta = './images/site/pagina/home/carrosel/';
            $map = directory_map($pasta,1);
                if(empty($map)) {
                    //echo '<p>Nenhuma imagem encontrada.</p>';
                    $data['warning'] = $this->lang->line('warning_no_registration_found');
                    $this->load->view('templates/alertas',$data);
                }else{?>
                    <table>
                        <thead>
                            <tr>
                                <th>Miniatura</th>
                                <th>Nome</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php foreach($map as $img){ ?>
                                <tr>
                                    <td><?= img($pasta.$img,FALSE,'style="width:12.500rem;"');?></td>
                                    <td><?= $img;?></td>
                                    <td><?= anchor('admin/pagina/home/carrosel/excluir/'.$img,'Excluir');?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
            <?php }?>
        </div>
    </div>
</div>

