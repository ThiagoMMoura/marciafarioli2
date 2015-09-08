<div class="row">
  <div class="small-12 columns text-center">
    <?php echo heading('UPLOAD DE IMAGENS PARA O CARROSEL',2);?>
  </div>
</div>
<div class="row">
  <div class="small-12 columns">
    <?php echo form_open_multipart('upload/carrosel',array('id'=>'uploadform'));?>
    <div class="row">
      <div class="large-12 columns">
		<?php 
        $form_file = array('name'=>'userfile','type'=>'file','size'=>'30');
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
<div class="row">
  <div class="small-12 columns">
  	<?php echo form_open('upload/carrosel',array('id'=>'cropform'));?>
		<?php 
        $form_file = array('name'=>'x','id'=>'x');
        echo form_label(form_hidden($form_file,''));
		$form_file = array('name'=>'y','id'=>'y');
        echo form_label(form_hidden($form_file,''));
		$form_file = array('name'=>'w','id'=>'w');
        echo form_label(form_hidden($form_file,''));
		$form_file = array('name'=>'h','id'=>'h');
        echo form_label(form_hidden($form_file,''));
        ?>
    <div class="row">
      <div class="large-12 columns">
		<?php echo form_submit('salvar', 'Salvar', 'class="button expand" id="btnsalvar"'); ?>
      </div>
    </div>    
    </form>
  </div>
</div>