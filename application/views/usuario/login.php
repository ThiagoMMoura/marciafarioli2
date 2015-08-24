<?php $this->load->view('templates/nav_header', $page); ?>
<div class="row">
  <div class="small-12 medium-6 columns">
    <?php echo form_open('usuario/login');?>
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
		echo form_label(form_input($form_email,''));
        ?>
      </div>
    </div>
    <div class="row">
      <div class="large-12 columns">
        <?php
		$form_senha = array('name'=>'senha','placeholder'=>'Senha');
		echo form_label(form_password($form_senha,''));
		?>
      </div>
    </div>
    <div class="row">
      <div class="large-12 columns">
        <?php
		echo form_submit('entrar', 'Entrar', 'class="button"');
		?>
      </div>
    </div>
    <?php
	echo form_close();
	?>
  </div>
  <!--CADASTRO-->
  <div class="small-12 medium-6 columns">
    <?php echo form_open('usuario/cadastro');?>
    <div class="row">
      <div class="large-12 columns">
        <?php
		echo heading('Cadastre-se',2);
		?>
      </div>
    </div>
    <div class="row">
      <div class="large-12 columns">
		<?php
		$form_nome = array('name'=>'nome','placeholder'=>'Nome Completo');
		echo form_label('Nome Completo'.form_input($form_nome,''));
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
      <div class="large-12 columns">
        <?php
		$form_senha = array('name'=>'repetir-senha','placeholder'=>'Repetir Senha');
		echo form_label('Repetir Senha'.form_password($form_senha,''));
		?>
      </div>
    </div>
    <div class="row">
      <div class="large-12 columns">
        <?php
		echo form_submit('salvar', 'Salvar', 'class="button"');
		?>
      </div>
    </div>
    <?php
	echo form_close();
	?>
  </div>
</div>
<?php $this->load->view('templates/footer'); ?>