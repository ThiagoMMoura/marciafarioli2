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
    function upload(){
        var options = {
            url: "<?= base_url('admin/pagina/home/carrosel/salvar/ajax');?>",
            //target: '#imgupload',
            cache: false,
            beforeSubmit: function(){
                $('#userfile').hide();
                $('.img-padrao').hide();
                
                $('#upload-box').addClass('background-load-img');
            },
            success: function(data){
                jQuery(function($) {
                    $('#imgcrop').Jcrop({
                        onChange: getCoordenadas,
                        onSelect: getCoordenadas,
                        bgColor:     'black',
                        bgOpacity:   .4,
                        aspectRatio: 10 / 4,
                        maxSize: [1000,400],
                        setSelect: [0,0,0,1000]
                    });
                });
                $('#acao').val('salvar');
                $('#crop-img').scr = data.scr;
                $('#url_uploaded').val($('#crop-img').attr('src'));
            },
            error: function(data){
                alert('error');
            }
        };
        jQuery('#uploadform').ajaxSubmit(options);
        return false;
    }
    function getCoordenadas(c){
	$('#x').val(c.x);
	$('#y').val(c.y);
	$('#x2').val(c.x2);
	$('#y2').val(c.y2);
	$('#w').val(c.w);
	$('#h').val(c.h);
	$('#real-w').val($('.jcrop-holder').css('width'));
	$('#real-h').val($('.jcrop-holder').css('height'));
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
            $ferramentas['limpar'] = TRUE;
            $ferramentas['salvar'] = array('id' => 'btnenviar');
            $ferramentas['adicionar'] = array('href'=>'admin/pagina/home/carrosel/editar');
            //$ferramentas['buscar'] = array('href'=>'admin/sistema/menu/busca');
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
                                <?= img('',FALSE,'id="crop-img"');?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div> 
        <?= form_close(); ?>
    </div>
</div>
