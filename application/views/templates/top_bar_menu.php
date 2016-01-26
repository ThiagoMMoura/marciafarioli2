<div class="fixed">
    <nav class="top-bar" data-topbar role="navigation">
        <ul class="title-area">
            <li class="name">
                <h1><?php echo anchor('home','Marcia Farioli'); ?></h1>
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
                <?php if($logged){ 
                    $this->top_bar->usar_urls_restritas($urls_restritas);
                    ?>
                    <li class="has-dropdown">
                        <?= anchor('#','Olá, ' . word_limiter($this->session->nome,1,'')); ?>
                        <ul class="dropdown">
                            <?php 
                            $where = array('grupo'=>'top bar menu usuario','sistema'=>TRUE);
                            $arvore = $this->menu_model->get_arvore_menus('*',$where,'ordem ASC');
                            $this->top_bar->criar($arvore);
                            $this->top_bar->imprimir();
                            ?>
                            <li class="divider"></li>
                            <li><?php echo anchor('usuario/sair','Sair'); ?></li>
                        </ul>
                    </li>
                    <?php 
                    $where = array('grupo'=>'top bar menu','sistema'=>TRUE);
                    $arvore = $this->menu_model->get_arvore_menus('*',$where,'ordem ASC');
                    $this->top_bar->criar($arvore);
                    $this->top_bar->imprimir();
                    ?>
		<?php }else{
                    $this->top_bar->usar_urls_restritas($urls_restritas);
                    $where = array('grupo'=>'top bar menu','sistema'=>FALSE);
                    $arvore = $this->menu_model->get_arvore_menus('*',$where,'ordem ASC');
                    $this->top_bar->criar($arvore);
                    $this->top_bar->imprimir();
                } ?>
            </ul>
        </section>
    </nav>
</div>