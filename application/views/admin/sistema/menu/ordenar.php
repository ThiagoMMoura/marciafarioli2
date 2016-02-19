<script type="text/javascript">
    function desativarOrdenadores(){
        $(".descer").removeClass("desativado");
        $(".subir").removeClass("desativado");
        $(".subir").first().addClass("desativado");
        $(".descer").last().addClass("desativado");
    }
    $(document).ready(function(){
        desativarOrdenadores();
        //função que faz a linha descer na tabela
        $(".descer").click(function(){
            var objLinha = $(this).parent().parent().parent().parent(); //Pega o objeto linha <tr>
            var id = $(objLinha).attr('id');
            var idnext = $(objLinha).next().attr('id');
            
            var ordemthis = $("input[name='ordem" + id + "'").val();
            if(ordemthis<<?= count($itens_menu);?>){
                var ordemnext = $("input[name='ordem" + idnext + "'").val();
                
                $(objLinha).hide("fast","linear",function(){
                    $("input[name='ordem" + id + "'").val(ordemnext);
                    $("input[name='ordem" + idnext + "'").val(ordemthis);
                    $(objLinha).next().after(objLinha);
                    desativarOrdenadores();
                }); //Abaixo da linha clicada, insere a linha clicada
                $(objLinha).show("fast","linear");
                
            }
        });

        //função que faz a linha subir na tabela
        $(".subir").click(function(){
            var objLinha = $(this).parent().parent().parent().parent(); //Pega o objeto linha <tr>
            var id = $(objLinha).attr('id');
            var idnext = $(objLinha).prev().attr('id');
            
            var ordemthis = $("input[name='ordem" + id + "'").val();
            if(ordemthis>1){
                var ordemnext = $("input[name='ordem" + idnext + "'").val();
                
                $(objLinha).hide("fast","linear",function(){
                    $("input[name='ordem" + id + "'").val(ordemnext);
                    $("input[name='ordem" + idnext + "'").val(ordemthis);
                    $(objLinha).prev().before(objLinha);
                    desativarOrdenadores();
                }); //Acima da linha clicada, insere a linha clicada
                $(objLinha).show("fast","linear");
                
            }
        });             
    });
</script>
<?= form_open('admin/sistema/menu/salvar_ordem'); ?>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Grupo</th>
                <th>Descrição</th>
                <th>Ordem</th>
            </tr>
        </thead>
        <tbody id="itens-ordenar-menu">
            <?php foreach($itens_menu as $item){ ?>
                <tr id="<?=$item['id'];?>">
                    <input name="iditem[]" type="hidden" value="<?= $item['id'];?>">
                    <td><?=$item['nome'];?></td>
                    <td><?=$item['grupo'];?></td>
                    <td><?=$item['descricao'];?></td>
                    <td><ul class="inline-list" style="margin: 0px;">
                            <li style="margin: 0px;"><input name="ordem<?= $item['id'];?>" type="text" value="<?=$item['ordem'];?>" style="margin: 0px; width: 3rem; text-align: center;" disabled></li>
                            <li><a href="javascript:void(0)" class="subir" ><i class="fi-arrow-up"></i></a></li>
                            <li><a href="javascript:void(0)" class="descer"><i class="fi-arrow-down"></i></a></li>
                        </ul>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <input type="submit" name="salvar" value="Salvar" class="button">
<?= form_close(); ?>


