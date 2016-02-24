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
            var objLinha = $(this).parent().parent(); //Pega o objeto linha <tr>
            
            if($(objLinha).next().length){
                $(objLinha).hide("fast","linear",function(){
                    $(objLinha).next().after(objLinha);
                    desativarOrdenadores();
                }); //Abaixo da linha clicada, insere a linha clicada
                $(objLinha).show("fast","linear");
            }
        });

        //função que faz a linha subir na tabela
        $(".subir").click(function(){
            var objLinha = $(this).parent().parent(); //Pega o objeto linha <tr>
            
            if($(objLinha).prev().length){
                $(objLinha).hide("fast","linear",function(){
                    $(objLinha).prev().before(objLinha);
                    desativarOrdenadores();
                }); //Acima da linha clicada, insere a linha clicada
                $(objLinha).show("fast","linear");
            }
        });             
    });
</script>
<?= form_open('admin/site/menu/salvar_ordem'); ?>
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
                    <td>
                        <a href="javascript:void(0)" class="subir" style="margin-right: 1.375rem"><i class="fi-arrow-up"></i></a>
                        <a href="javascript:void(0)" class="descer"><i class="fi-arrow-down"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <input type="submit" name="salvar" value="Salvar" class="button">
<?= form_close(); ?>


