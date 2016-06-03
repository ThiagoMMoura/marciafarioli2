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
                        <div class="album-up-img-header">
                            
                        </div>
                        <div class="album-up-img-box">
                            <ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-4">
                                <?php foreach ($fotos as $foto){ ?>
                                <li>
                                    <div class="album-img-container">
                                        <div class="album-img-item">
                                            <div class="album-img-thumb">
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
                        <div class="jFiler jFiler-theme-dragdropbox">
                            <!--input type="file" name="files[]" id="filer_input" multiple="multiple" style="position: absolute; left: -9999px; top: -9999px; z-index: -9999;">
                            <div class="jFiler-input-dragDrop"><div class="jFiler-input-inner"><div class="jFiler-input-icon"><i class="icon-jfi-cloud-up-o"></i></div><div class="jFiler-input-text"><h3>Drag&Drop files here</h3> <span style="display:inline-block; margin: 15px 0">or</span></div><a class="jFiler-input-choose-btn blue">Browse Files</a></div></div>
                            <div class="jFiler-items jFiler-row">
                                <ul class="jFiler-items-list jFiler-items-grid">
                                    <?php foreach ($fotos as $foto){ ?>
                                        <li class="jFiler-item">
                                            <div class="jFiler-item-container">
                                                <div class="jFiler-item-inner">
                                                    <div class="jFiler-item-thumb">
                                                        <div class="jFiler-item-status"></div>
                                                        <div class="jFiler-item-info">
                                                            <span class="jFiler-item-title"><b title="<?= $foto['nome'];?>"><?= character_limiter($foto['nome'],25);?></b></span>
                                                            <span class="jFiler-item-others">0</span>
                                                        </div>
                                                        <?= img($foto['url']);?>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </li>
                                    <?php } ?>

                                </ul>
                            </div-->
                            
                        </div>
                    </div>
                </div>

            </div>
        <?= form_close(); ?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#filer_input').filer({
            //changeInput: '<div class="jFiler-input-dragDrop"><div class="jFiler-input-inner"><div class="jFiler-input-icon"><i class="icon-jfi-cloud-up-o"></i></div><div class="jFiler-input-text"><h3>Drag&Drop files here</h3> <span style="display:inline-block; margin: 15px 0">or</span></div><a class="jFiler-input-choose-btn blue">Browse Files</a></div></div>',
            changeInput: ' ',        
            showThumbs: true,
            theme: "dragdropbox",
            templates: {
                box: '<ul class="jFiler-items-list jFiler-items-grid"></ul>',
                item: '<li class="jFiler-item">\
                            <div class="jFiler-item-container">\
                                <div class="jFiler-item-inner">\
                                    <div class="jFiler-item-thumb">\
                                        <div class="jFiler-item-status"></div>\
                                        <div class="jFiler-item-info">\
                                            <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                            <span class="jFiler-item-others">{{fi-size2}}</span>\
                                        </div>\
                                        {{fi-image}}\
                                    </div>\
                                    <div class="jFiler-item-assets jFiler-row">\
                                        <ul class="list-inline pull-left">\
                                            <li>{{fi-progressBar}}</li>\
                                        </ul>\
                                        <ul class="list-inline pull-right">\
                                            <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                        </ul>\
                                    </div>\
                                </div>\
                            </div>\
                        </li>',
                itemAppend: '<li class="jFiler-item">\
                                <div class="jFiler-item-container">\
                                    <div class="jFiler-item-inner">\
                                        <div class="jFiler-item-thumb">\
                                            <div class="jFiler-item-status"></div>\
                                            <div class="jFiler-item-info">\
                                                <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                                <span class="jFiler-item-others">{{fi-size2}}</span>\
                                            </div>\
                                            {{fi-image}}\
                                        </div>\
                                        <div class="jFiler-item-assets jFiler-row">\
                                            <ul class="list-inline pull-left">\
                                                <li><span class="jFiler-item-others">{{fi-icon}}</span></li>\
                                            </ul>\
                                            <ul class="list-inline pull-right">\
                                                <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                            </ul>\
                                        </div>\
                                    </div>\
                                </div>\
                            </li>',
                progressBar: '<div class="bar"></div>',
                itemAppendToEnd: false,
                removeConfirmation: true,
                _selectors: {
                    list: '.jFiler-items-list',
                    item: '.jFiler-item',
                    progressBar: '.bar',
                    remove: '.jFiler-item-trash-action'
                }
            },
            dragDrop: {
                dragEnter: null,
                dragLeave: null,
                drop: null
            },
            addMore:false,
            uploadFile: {
                url: "<?= site_url('admin/site/portfolio/upload');?>",
                data: {id : $('[name="id"]').val(), url: $('[name="url"]').val()},
                type: 'POST',
                enctype: 'multipart/form-data',
                beforeSend: function(){},
                success: function(data, el){
                    var parent = el.find(".jFiler-jProgressBar").parent();
                    el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
                        $("<div class=\"jFiler-item-others text-success\"><i class=\"icon-jfi-check-circle\"></i> Success</div>").hide().appendTo(parent).fadeIn("slow");    
                    });
                },
                error: function(el){
                    var parent = el.find(".jFiler-jProgressBar").parent();
                    el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
                        $("<div class=\"jFiler-item-others text-error\"><i class=\"icon-jfi-minus-circle\"></i> Error</div>").hide().appendTo(parent).fadeIn("slow");    
                    });
                },
                statusCode: null,
                onProgress: null,
                onComplete: null
            }
        });
    });
</script>

