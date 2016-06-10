<?php $this->load->view('templates/alertas'); 
$hidden['id'] = set_value('id',$id);
$hidden['url'] = set_value('url',$url);
$field['nome'] = array(
    'input' => array('name'=>'nome','placeholder'=>'Nome do Album','value'=>set_value('nome',$nome),'required'=>''),
    'label' => 'Nome Album'
);
$field['descricao'] = array(
    'textarea' => array('name'=>'descricao','placeholder'=>'Descreva o conteúdo do album...','value'=>set_value('descricao',$descricao),'rows'=>3,'cols'=>300),
    'label' => 'Descrição'
);
?>

<div class="row">
    <div class="medium-12 medium-centered column">
        <?= form_open_multipart('admin/site/portfolio/upload','',$hidden); ?>
            <?php
            $ferramentas['title'] = 'Album de Fotos - Portfolio';
            $ferramentas['adicionar'] = array('href'=>'admin/sistema/album/cadastro');
            $ferramentas['buscar'] = array('href'=>'admin/site/portfolio/albuns');
            $ferramentas['salvar'] = TRUE;
            $this->load->view('templates/barra_ferramentas',$ferramentas);
            ?>
            <div class="panel">
                <div class="row">
                    <div class="medium-12 columns">
                        <?= get_form_field($field['nome']);?>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-12 columns">
                        <?= get_form_field($field['descricao']);?>
                    </div>
                </div>
                <div class="row">
                    <div class="medium-12 columns">
                        <div class="album-up-img-box">
                            <ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-4" id="album-up-list">
                                <li>
                                    <div class="imagem-upload-box">
                                        <div class="album-up-img-button">
                                            <?= img($url_imagem_add);?>
                                            <input type="file" name="files[]" id="up_img" multiple="multiple">
                                        </div>
                                    </div>
                                </li>
                                <?php foreach ($fotos as $foto){ ?>
                                <li id="img-<?= $foto['id'];?>" <?= $idcapa==$foto['id']?'class="capa"':'';?>>
                                    <div class="album-img-container">
                                        <div class="album-img-item">
                                            <div class="album-img-thumb">
                                                <div class="album-img-action">
                                                    <a name="excluir" onclick="excluir(<?= $foto['id'];?>)"><i class="fi-trash" ></i></a>
                                                    <a name="alterar_capa" onclick="tornarCapa(<?= $foto['id'];?>)"><i class="fi-photo"></i></a>
                                                </div>
                                                <div class="album-img-info">
                                                </div>
                                                <div class="album-img-thumb-image">
                                                    <?= img($foto['url']);?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        <?= form_close(); ?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#up_img').on('change',function(event){
            files = event.target.files;
            
            $.each(files,function(key,value){
                $("#album-up-list").append('<li id="up-item-box-'+key+'">'+
                                    '<div class="album-img-container">'+
                                        '<div class="album-img-item">'+
                                            '<div class="album-img-thumb">'+
                                                '<div class="album-img-action">'+
                                                    '<a name="excluir" ><i class="fi-trash" ></i></a>'+
                                                    '<a name="alterar_capa" ><i class="fi-photo"></i></a>'+
                                                '</div>'+
                                                '<div class="album-img-info">'+
                                                '</div>'+
                                                '<div class="album-img-thumb-image">'+
                                                    '<?= img($url_ajax_load_gif);?>'+
                                                '</div>'+
                                            '</div>\
                                        </div>\
                                    </div>\
                                </li>');
                var formData = new FormData();
                formData.append('id',$('[name="id"]').val());
                formData.append('url',$('[name="url"]').val());
                formData.append('files',value);

                $.ajax({
                    url: "<?= site_url('admin/site/portfolio/upload');?>",
                    data: formData,
                    type: 'POST',
                    processData: false, // Don't process the files
                    contentType: false,
                    dataType: 'json',
                    success: function(data){
                        $('#up-item-box-'+key).find('img').attr('src',data.imagem.url);
                        $('#up-item-box-'+key).find('[name="excluir"]').attr('onclick','excluir('+data.imagem.id+')');
                        $('#up-item-box-'+key).find('[name="alterar_capa"]').attr('onclick','tornarCapa('+data.imagem.id+')');
                        $('#up-item-box-'+key).attr('id','img-'+data.imagem.id);
                    }
                });
            });
        });
    });
    function excluir(id){
        $.ajax({
            url: "<?= site_url('admin/site/portfolio/excluir');?>",
            data: {id: id},
            type: 'POST',
            dataType: 'json',
            success: function(data){
                if(data.estatus==='sucesso'){
                    $('#img-'+id).remove();
                }else{
                    $('.alert-area').last().after(data.alertas);
                }
            },
            error: function(el){
                console.log("Erro ao excluir imagem");
            }
        });
    }
    function tornarCapa(id){
        if(!$('#img-'+id).hasClass('capa')){
            $.ajax({
                url: "<?= site_url('admin/site/portfolio/alterar_capa');?>",
                data: {idalbum: <?= $id;?>,idcapa: id},
                type: 'POST',
                dataType: 'json',
                success: function(data){
                    if(data.estatus==='sucesso'){
                        $('.capa').removeClass('capa');
                        $('#img-'+id).addClass('capa');
                    }else{
                        $('.alert-area').last().after(data.alertas);
                    }
                },
                error: function(el){
                    console.log("Erro ao alterar capa");
                }
            });
        }
    }
</script>

