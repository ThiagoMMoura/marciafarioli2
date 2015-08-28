<div class="fixed">
  <nav class="top-bar" data-topbar role="navigation">
    <ul class="title-area">
      <li class="name">
        <h1><a href="#">Marcia Farioli</a></h1>
      </li>
      <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
    </ul>
    <section class="top-bar-section">
      <ul class="right">
        <li class="has-form">
          <div class="row collapse">
            <div class="large-8 small-9 columns">
              <input type="text" placeholder="Encontrar...">
            </div>
            <div class="large-4 small-3 columns">
              <a href="#" class="alert button expand">Buscar</a>
            </div>
          </div>
        </li>
        <li class="divider"></li>
		<?php if($this->usuario_model->logado()){ ?>
        	<li class="has-dropdown">
            	<?php echo anchor('#','Olá, '.word_limiter($this->session->nome,1,'')); ?>
                <ul class="dropdown">
                	<?php if($perm->postar)echo '<li>'.anchor('','Novo Post').'</li>'; ?>
                    <li class="divider"></li>
                	<li><?php echo anchor('usuario/sair','Sair'); ?></li>
                </ul>
            </li>
		<?php }else{ ?>
			<li><?php echo anchor('usuario/login','Entre'); ?></li>
            <li class="divider"></li>
            <li><?php echo anchor('usuario/cadastro','Cadastre-se');?></li>
        <?php } ?>
      </ul>
    </section>
  </nav>
</div>