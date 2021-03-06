﻿<?php
$this->load->view('templates/nav_header'); 
$this->load->view('templates/alertas');
?>
<div class="row">  
  <div class="small-12 medium-centered medium-6 columns">
	<?php echo validation_errors(); ?>
    <?php echo form_open('usuario/entrar');?>
    <div class="row">
      <div class="large-12 columns">
        <?php
		echo heading('Entre',2);
		?>
      </div>
    </div>
    <div class="row">
      <div class="large-12 columns">
		<?php
		$form_email = array('name'=>'email','placeholder'=>'Seu email');
		echo form_label('Email'.form_input($form_email,''));
        ?>
      </div>
    </div>
    <div class="row">
      <div class="large-12 columns">
        <?php
		$form_senha = array('name'=>'senha','placeholder'=>'Senha');
		echo form_label('Senha'.form_password($form_senha,''));
		?>
      </div>
    </div>
    <div class="row">
      <div class="large-12 columns text-right">
        <?php echo form_label(anchor('usuario/recuperarsenha','Esqueci a minha senha.')); ?><br />
      </div>
    </div>
    <div class="row">
      <div class="large-12 columns">
        <?php echo form_submit('entrar', 'Entrar', 'class="button expand"'); ?>
      </div>
    </div>
    <?php
	echo form_close();
	?>
    <div class="row">
      <div class="large-12 columns text-center">
        <p>Ainda não sou cadastrado, <?php echo anchor('usuario/cadastro','Clique aqui'); ?>.</p>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('templates/footer'); ?>