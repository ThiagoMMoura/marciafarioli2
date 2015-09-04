<div class="row">
  <div class="small-12 columns text-center">
    <?php echo heading('UPLOAD DE IMAGENS PARA O CARROSEL',2);?>
  </div>
</div>
<div class="row">
  <div class="small-12 columns">
    <?php echo form_open_multipart('upload/carrosel');?>
    <div class="row">
      <div class="large-12 columns">
		<?php 
        $form_file = array('name'=>'userfile','type'=>'file','size'=>'20');
        echo form_label(form_input($form_file,''));
        ?>
      </div>
    </div>
    <div class="row">
      <div class="large-12 columns">
		<?php echo form_submit('upload', 'Enviar', 'class="button expand" id="btnenviar"'); ?>
      </div>
    </div>    
    </form>
  </div>
</div>
<div class="row">
  <div class="small-12 columns" id="imgupload">
  </div>
</div>