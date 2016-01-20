<?php $this->load->library('top_bar');?>
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
                        <?=anchor('#','Olá, '.word_limiter($this->session->nome,1,'')); ?>
                        <ul class="dropdown">
                            <? $where = array('grupo'=>'Top Bar Menu Usuario','sistema'=>TRUE);
                            $arvore = $this->menu_model->get_arvore_menus('*',$where,'ordem ASC');
                            $this->top_bar->criar($arvore);
                            $this->top_bar->imprimir();
                            /*$menus = $this->menu_model->getResultados();
                            foreach ($menus as $menu){
                               echo $menu->getMenuHTML();
                            }
                            
                            <?=$perm->postar?'<li>'.anchor('','Novo Post').'</li>':''; ?>
                            <?=$perm->postar?'<li>'.anchor('admin/editar/album','Criar Portfolio').'</li>':''; ?>
                             */
                            ?>
                            <li class="divider"></li>
                            <li><?php echo anchor('usuario/sair','Sair'); ?></li>
                        </ul>
                    </li>
                    <? $where = array('grupo'=>'Top Bar Menu','sistema'=>TRUE);
                    $arvore = $this->menu_model->get_arvore_menus('*',$where,'ordem ASC');
                    $this->top_bar->criar($arvore);
                    $this->top_bar->imprimir();
//                    $this->menu_model->selecionar('*',$where,'ordem ASC');
//                    $menus = $this->menu_model->getResultados();
//                    foreach ($menus as $menu){
//                       echo '<li class="divider"></li>';
//                       echo $menu->getMenuHTML();
//                    }
                    ?>
		<?php }else{
                    $this->top_bar->usar_urls_restritas($urls_restritas);
                    $where = array('grupo'=>'Top Bar Menu','sistema'=>FALSE);
                    $arvore = $this->menu_model->get_arvore_menus('*',$where,'ordem ASC');
                    $this->top_bar->criar($arvore);
                    $this->top_bar->imprimir();
//                    $this->menu_model->selecionar('*',$where,'ordem ASC');
//                    $menus = $this->menu_model->getResultados();
//                    $cont = 0;
//                    foreach ($menus as $menu){
//                       echo $cont > 0?'<li class="divider"></li>':'';
//                       echo $menu->getMenuHTML();
//                       $cont++;
//                    }
                } ?>
            </ul>
        </section>
    </nav>
</div>