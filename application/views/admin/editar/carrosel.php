<?php $this->load->helper('directory'); ?>
<div class="row">
  <div class="small-12 columns text-center">
    <?php echo heading('Adicionar imagem ao Carrosel:',2);?>
  </div>
</div>
<div class="row">
  <div class="small-12 columns">
    <?php echo form_open_multipart('admin/carrosel/upload',array('id'=>'uploadform'));?>
    <div class="row">
      <div class="large-12 columns">
		<?php 
        $form_file = array('name'=>'userfile','type'=>'file','size'=>'50','id'=>'userfile');
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
      	<ul class="button-group even-2">
			<li><?php echo form_submit('salvar', 'Salvar', 'class="button" id="btnsalvar" style="display: none;"'); ?></li>
			<li><?php echo form_submit('cancelar', 'Cancelar', 'class="button" id="btncancelar" style="display: none;"'); ?></li>
        </ul>
      </div>
    </div>    
    </form>
  </div>
</div>
<div class="row">
  <div class="small-12 columns text-center">
    <?php echo heading('Imagens do carrosel',2);?>
  </div>
</div>
<div class="row">
	<div class="carrosel-lista">
    	<ul class="small-block-grid-1 medium-block-grid-3 large-block-grid-5">
		<?php
        $pasta = './images/site/carrosel/';
        $map = directory_map($pasta,1);
		if(empty($map)) echo '<p>Nenhuma imagem encontrada.</p>';
		else{
			foreach($map as $img){ ?>
				<li><?php echo img($pasta.$img); 
				echo anchor('admin/carrosel/excluir/'.$img,'Excluir');
				?></li>
        <?php } 
		}?>
        </ul>
    </div>
</div>