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
		<?php if($this->session->has_userdata('logado')&&$this->session->logado){?>
            <li><?php echo anchor('',$this->session->name); ?></li>
		<?php }else{ ?>
			<li><?php echo anchor('usuario/login','Entre'); ?></li>
            <li class="divider"></li>
            <li><?php echo anchor('usuario/cadastro','Cadastre-se');?></li>
        <?php } ?>
      </ul>
    </section>
  </nav>
</div>