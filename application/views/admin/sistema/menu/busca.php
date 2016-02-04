<? $this->load->view('templates/alertas'); ?>
<script type="text/javascript">
    $(function(){
        //função que faz a linha descer na tabela
        $(".descer").click(function(){
            var objLinha = $(this).parent().parent(); //Pega o objeto linha <tr>
            var id = $(objLinha).attr('id');
            var idnext = $(objLinha).next().attr('id');
            
            var valor = $("input[name='ordem" + id + "'").val();
            $("input[name='ordem" + id + "'").val($("input[name='ordem" + idnext + "'").val());
            $("input[name='ordem" + idnext + "'").val(valor);
            
            $(objLinha).next().after(objLinha); //Abaixo da linha clicada, insere a linha clicada
        });

        //função que faz a linha subir na tabela
        $(".subir").click(function(){
            var objLinha = $(this).parent().parent(); //Pega o objeto linha <tr>
            var id = $(objLinha).attr('id');
            var idnext = $(objLinha).prev().attr('id');
            
            var valor = $("input[name='ordem" + id + "'").val();
            $("input[name='ordem" + id + "'").val($("input[name='ordem" + idnext + "'").val());
            $("input[name='ordem" + idnext + "'").val(valor);
            
            $(objLinha).prev().before(objLinha); //Acima da linha clicada, insere a linha clicada
        });             

    });
</script>

<div id="popup-ordenar-menu" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
    <h2 id="modalTitle">Menu</h2>
    <?= form_open('admin/sistema/menu/salvar_ordem','',$hidden); ?>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Grupo</th>
                <th>Descrição</th>
                <th>Ordem</th>
            </tr>
        </thead>
        <tbody id="itens_ordenar_menu">
            
        </tbody>
    </table>
    <input type="submit" name="salvar" value="Salvar">
    <?= form_close(); ?>
    <a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>

<script type="text/javascript">
    function ordenar(idmenupai){
        $.ajax({
            method: "POST",
            url: "admin/sistema/menu/ordenar",
            data: { id : idmenupai, requisicao : "ajax"},
            dataType: "json"
        }).done(function(retorno){
            var obj = jQuery.parseJSON(retorno);
            $('#itens_ordenar_menu').empty();
            var i;
            var html = '';
            for(i in obj.itens){
                html += '<tr id="' + obj.itens[i]['id'] '">';
                html += '<input name="id[]" type="hidden" value="' + obj.itens[i]['id'] '">';
                html += '<td>' + obj.itens[i]['nome'] + '</td>';
                html += '<td>' + obj.itens[i]['grupo'] + '</td>';
                html += '<td>' + obj.itens[i]['descricao'] + '</td>';
                html += '<td><input name="ordem'+ obj.itens[i]['id'] + '" type="text" value="' + obj.itens[i]['ordem'] + '" disabled>' +
                    '<a href="javascript:void(0)" class="subir"><i class="fi-arrow-up"></i></a>' +
                    '<a href="javascript:void(0)" class="descer"><i class="fi-arrow-down"></i></a></td>';
                html += '</tr>';
            }
            $('#itens_ordenar_menu').add(html);
            $('#popup-ordenar-menu').foundation('reveal', 'open');
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
                            <th class="visible-for-medium-up" width="164px">Grupo</th>
                            <th width="180px">Nome</th>
                            <th class="visible-for-medium-up" width="340px">Descrição</th>
                            <th width="180px">Menu Pai</th>
                            <th>Ações</th>
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
                            <td><?= anchor('admin/sistema/menu/editar/' . $menu['id'], 'Editar');?>
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

