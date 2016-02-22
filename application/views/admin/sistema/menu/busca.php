<? $this->load->view('templates/alertas'); ?>

<div id="popup-ordenar-menu">
    
</div>

<script type="text/javascript">
    function ordenar(idmenupai){
        $.ajax({
            method: "POST",
            url: "<?= base_url("admin/sistema/menu/ordenar");?>",
            data: { id : idmenupai, formato : "painel-suspenso"},
            dataType: 'html',
            success: function(data){
                $("#popup-ordenar-menu").empty();
                $('#popup-ordenar-menu').html(data);
                $('#menu-' + idmenupai).foundation('reveal', 'open');
            },
            error: function (XMLHttpRequest, textStatus, errorThrown){ 
                alert("Não foi possível carregar os dados!"); 
            }
        });
    }
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
                            <th class="visible-for-medium-up" width="154px">Grupo</th>
                            <th width="180px">Nome</th>
                            <th class="visible-for-medium-up" width="270px">Descrição</th>
                            <th width="180px">Menu Pai</th>
                            <th width="100px">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
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
                            <td >
                                <?= anchor('admin/sistema/menu/editar/' . $menu['id'], '<i class="fi-pencil"></i>');?>
                                <?php
                                    if($menu['formato']=='dropdown'){
                                        echo '<a href="javascript:ordenar(' . $menu['id'] . ')">Ordenar</a>';
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

