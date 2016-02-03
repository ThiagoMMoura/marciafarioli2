<? $this->load->view('templates/alertas'); ?>
<script type="text/javascript">
    $(function(){
        //função que faz a linha descer na tabela
        $(".descer").click(function(){
            var objLinha = $(this).parent().parent(); //Pega o objeto linha <tr>
            $(objLinha).next().after(objLinha); //Abaixo da linha clicada, insere a linha clicada
        });

        //função que faz a linha subir na tabela
        $(".subir").click(function(){
            var objLinha = $(this).parent().parent(); //Pega o objeto linha <tr>
            $(objLinha).prev().before(objLinha); //Acima da linha clicada, insere a linha clicada
        });             

    });

</script>
<div class="row">
    <div class="medium-12 medium-centered column">
        <?php
        $ferramentas['title'] = 'Busca de Menu';
        $ferramentas['adicionar'] = array('href'=>'admin/sistema/menu/cadastro');
        $this->load->view('templates/barra_ferramentas',$ferramentas);
        ?>
        <div class="panel">
            <?php
            if(isset($menus) && !empty($menus)){?>
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
                    <?php $menu_pai_anterior = -1;
                    foreach(array_reverse($menus) as $key => $menu){
                        $menus[$key]['pra_baixo'] = $menus[$key]['pra_cima'] = FALSE;
                        if($menu['idmenupai']==$menu_pai_anterior){
                            $menus[$key]['pra_baixo'] = TRUE;
                        }
                        if($menu['ordem']>1){
                            $menus[$key]['pra_cima'] = TRUE;
                        }
                        $menu_pai_anterior = $menu['idmenupai'];
                    }
                    ?>
                    <?php foreach($menus as $menu){?>
                        <tr id="<?= $menu['id'];?>">
                            
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
                            <td><?= anchor('admin/sistema/menu/editar/' . $menu['id'], 'Editar');?>
                                <?php
                                    if($menu['pra_cima']){
                                        echo '<a href="javascript:void(0)" class="subir"><i class="fi-arrow-up"></i></a>';
                                    }
                                    if($menu['pra_baixo']){
                                        echo '<a href="javascript:void(0)" class="descer"><i class="fi-arrow-down"></i></a>';
                                    }
                                ?>
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

