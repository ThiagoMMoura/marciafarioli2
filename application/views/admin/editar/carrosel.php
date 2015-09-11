<div class="row">
  <div class="small-12 columns text-center">
    <?php echo heading('UPLOAD DE IMAGENS PARA O CARROSEL',2);?>
  </div>
</div>
<div class="row">
  <div class="small-12 columns">
    <?php echo form_open_multipart('admin/carrosel/upload',array('id'=>'uploadform'));?>
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
  	<?php echo form_open('admin/carrosel/crop',array('id'=>'cropform'));?>
		<?php 
        $form_file = array('type'=>'hidden','name'=>'x','id'=>'x');
        echo form_label(form_input($form_file));
		$form_file = array('type'=>'hidden','name'=>'y','id'=>'y');
        echo form_label(form_input($form_file));
		$form_file = array('type'=>'hidden','name'=>'x2','id'=>'x2');
        echo form_label(form_input($form_file));
		$form_file = array('type'=>'hidden','name'=>'y2','id'=>'y2');
        echo form_label(form_input($form_file));
		$form_file = array('type'=>'hidden','name'=>'w','id'=>'w');
        echo form_label(form_input($form_file));
		$form_file = array('type'=>'hidden','name'=>'h','id'=>'h');
        echo form_label(form_input($form_file));
		$form_file = array('type'=>'hidden','name'=>'real-w','id'=>'real-w');
        echo form_label(form_input($form_file));
		$form_file = array('type'=>'hidden','name'=>'real-h','id'=>'real-h');
        echo form_label(form_input($form_file));
		$form_file = array('type'=>'hidden','name'=>'url','id'=>'url');
        echo form_label(form_input($form_file));
        ?>
    <div class="row">
      <div class="large-12 columns">
		<?php echo form_submit('salvar', 'Salvar', 'class="button expand" id="btnsalvar"'); ?>
      </div>
    </div>    
    </form>
  </div>
</div>