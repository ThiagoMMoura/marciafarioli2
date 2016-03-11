<?php $this->load->view('templates/alertas'); 
$this->load->helper('directory');
// Declaração de arrays de inputs , labels e hiddens.
$field['acao'] = array(
    'input' => array('type' => 'hidden','name' => 'acao','id' => 'acao','value'=>set_value('acao',$acao))
);
$field['x'] = array(
    'input' => array('type' => 'hidden','name' => 'x','id' => 'x')
);
$field['y'] = array(
    'input' => array('type' => 'hidden','name' => 'y','id' => 'y')
);
$field['x2'] = array(
    'input' => array('type' => 'hidden','name' => 'x2','id' => 'x2')
);
$field['y2'] = array(
    'input' => array('type' => 'hidden','name' => 'y2','id' => 'y2')
);
$field['w'] = array(
    'input' => array('type' => 'hidden','name' => 'w','id' => 'w')
);
$field['h'] = array(
    'input' => array('type' => 'hidden','name' => 'h','id' => 'h')
);
$field['real_w'] = array(
    'input' => array('type' => 'hidden','name' => 'real_w','id' => 'real_w')
);
$field['real_h'] = array(
    'input' => array('type' => 'hidden','name' => 'real_h','id' => 'real_h')
);
$field['url_uploaded'] = array(
    'input' => array('type' => 'hidden','name' => 'url_uploaded','id' => 'url_uploaded','value'=>  set_value('url_uploaded',$url_uploaded))
);
$field['userfile'] = array(
    'input' => array('name'=>'userfile','type'=>'file','size'=>'50','id'=>'userfile','onchange'=>'upload()'),
    'label' => ''
);
?>
<script type="text/javascript">
    var cancelar_count = 0;
    function upload(){
        var options = {
            //url: "<?= base_url('admin/pagina/home/carrosel/salvar/ajax');?>",
            //target: '#imgupload',
            cache: false,
            dataType: 'json',
            beforeSubmit: function(){
                $('#userfile').hide();
                $('.img-padrao').hide();
                $('#salvar').prop('disabled',true);
                $('#upload-box').addClass('background-load-img');
            },
            success: function(data){
                $('#upload-box').append('<img src="'+data.src+'" id="crop-img" />');
                jQuery(function($) {
                    $('#crop-img').Jcrop({
                        onChange: getCoordenadas,
                        onSelect: getCoordenadas,
                        bgColor:     'black',
                        bgOpacity:   .4,
                        aspectRatio: <?= $max_width_image_carrosel;?> / <?= $max_height_image_carrosel;?>,
                        maxSize: [<?= $max_width_image_carrosel;?>,<?= $max_height_image_carrosel;?>],
                        setSelect: [0,0,0,<?= $max_width_image_carrosel;?>]
                    });
                });
                $('#acao').val('salvar');
                $('#url_uploaded').val(data.src);
                $('#upload-box').removeClass('background-load-img');
            },
            error: function(data){
                $('#acao').val('upload');
                $('#userfile').show();
                $('.img-padrao').show();
                $('.alert-area').html('<div class="small-12 columns"><?= alert_div('Um erro ocorreu ao enviar a imagem automaticamente.','alert'); ?></div>');
                console.error(data);
            }
        };
        jQuery('#uploadform').ajaxSubmit(options);
        $('#salvar').prop('disabled',false);
        $('#upload-box').removeClass('background-load-img');
        return false;
    }
    function getCoordenadas(c){
	$('#x').val(c.x);
	$('#y').val(c.y);
	$('#x2').val(c.x2);
	$('#y2').val(c.y2);
	$('#w').val(c.w);
	$('#h').val(c.h);
	$('#real_w').val($('.jcrop-holder').css('width'));
	$('#real_h').val($('.jcrop-holder').css('height'));
    }
    function cancelar(){
        cancelar_count++;
        if(cancelar_count<2){
            $.ajax({
                url:'<?= base_url('admin/pagina/home/carrosel/cancelar');?>',
                method: "POST",
                data: { ajax : "1", url_uploaded : $('#url_uploaded').val()},
                error: function(data){
                    alert('error ' + data);
                }
            }).done(function(data){
                if(data==='1'){
                    $('#acao').val('upload');
                    $('#userfile').show();
                    $('.img-padrao').show();
                    $('#crop-img').remove();
                    $('.jcrop-holder').remove();
                }else{
                    alert('Não é possível cancelar.');
                }
                return false;
            });
        }else{
            cancelar_count = 0;
        }
    }
</script>

<div class="row">
    <div class="small-12 columns">
        <?= form_open_multipart('admin/pagina/home/carrosel/salvar',array('id'=>'uploadform')) .
            get_form_field($field['acao']) .
            get_form_field($field['x']) .
            get_form_field($field['y']) .
            get_form_field($field['x2']) .
            get_form_field($field['y2']) .
            get_form_field($field['w']) .
            get_form_field($field['h']) .
            get_form_field($field['real_w']) .
            get_form_field($field['real_h']) .
            get_form_field($field['url_uploaded']);
            ?>
            <?php 
            $ferramentas['title'] = 'EDITAR CARROSEL';
            $ferramentas['limpar'] = array('extra'=>'onclick="cancelar()"','text'=>'Cancelar');
            $ferramentas['salvar'] = TRUE;
            $ferramentas['adicionar'] = array('href'=>'admin/pagina/home/carrosel/editar');
            $ferramentas['buscar'] = array('href'=>'admin/pagina/home/carrosel/busca');
            $this->load->view('templates/barra_ferramentas',$ferramentas);
            ?>
            <div class="panel">
                <div class="row">
                    <div class="large-12 columns">
                        <div class="imagem-upload-box" id="upload-box">
                            <?php if($acao==='salvar'){
                                echo img(set_value('url_uploaded',$url_uploaded),FALSE,'id="crop-img"');
                            }else{ ?>
                                <?= img("images/site/adicionar/adicionar_imagem_1000x400.png",FALSE,'class="img-padrao"');?>
                                <?= get_form_field($field['userfile']);?>
                                <span id="background-load-img" style="display:none;"></span>
                                
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div> 
        <?= form_close(); ?>
    </div>
</div>
