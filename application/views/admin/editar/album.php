<?php $this->load->view('templates/alertas'); ?>
<div class="row">
  <div class="small-12 columns text-center">
    <?php echo heading('Criar Album',2);?>
  </div>
</div>
<div class="row">
  <div class="small-12 columns">
    <?php echo form_open('admin/portfolio/criar_album',array('id'=>'albumform'));?>
    <div class="row">
      <div class="large-12 columns">
		<?php 
        $form_nome = array('name'=>'nome_album','type'=>'text','id'=>'nome_album','placeholder'=>'Insira um nome.','required'=>'');
		$atributos = array();
		if(form_error('nome_album')!=NULL) $atributos['class'] = isset($atributos['class'])?$atributos['class'].' error':'error';
        echo form_label('Nome'.form_input($form_nome,''),'',$atributos);
		echo form_error('nome_album');
        ?>
      </div>
    </div>
    <div class="row">
      <div class="large-12 columns">
	  	<?php
      	$form_descricao = array('name'=>'descricao_album','value'=>set_value('descricao_album'),'id'=>'descricao_album','placeholder'=>'Insira uma descrição...');
        echo form_label('Descrição'.form_textarea($form_descricao));
		?>
      </div>
    </div>

    <div class="row">
      <div class="large-12 columns">
		<?php echo form_submit('enviar', 'Criar', 'class="button expand" id="btncriar"'); ?>
      </div>
    </div>    
    </form>
  </div>
</div>