<?php $this->load->view('templates/alertas'); ?>
<div class="row">
  <div class="small-12 columns text-center">
    <?php echo heading('Adicionar imagem ao Album:',2);?>
  </div>
</div>
<div class="row">
  <div class="small-12 columns">
    <?php echo form_open_multipart('admin/portfolio/upload',array('id'=>'uploadform'));?>
    <div class="row">
      <div class="large-12 columns">
		<?php 
        $form_file = array('name'=>'userfile','type'=>'file','size'=>'50','id'=>'userfile','multiple'=>'');
        echo form_label(form_input($form_file,''));
        ?>
      </div>
    </div>
    <div class="row">
      <div class="large-12 columns">
	  	<?php
      	$form_file = array('type'=>'text','name'=>'file_name','id'=>'file_name');
        echo form_label(form_input($form_file));
		?>
      </div>
    </div>
    <?php
	$form_file = array('type'=>'hidden','name'=>'idalbum','id'=>'idalbum','value'=>$idalbum);
    echo form_label(form_input($form_file));
	?>
    <div class="row">
      <div class="large-12 columns">
		<?php echo form_submit('upload', 'Enviar', 'class="button expand" id="btnenviar"'); ?>
      </div>
    </div>    
    </form>
  </div>
</div>

<div class="row">
	<div class="upload-lista">
    	<ul class="small-block-grid-1 medium-block-grid-3 large-block-grid-5">
		
        </ul>
    </div>
</div>