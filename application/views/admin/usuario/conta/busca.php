<? $this->load->view('templates/alertas'); ?>
<div class="row">
    <div class="medium-12 medium-centered column">
        <?php
        $ferramentas['title'] = 'Busca UsuÁrios';
        $ferramentas['adicionar'] = array('href'=>'admin/usuario/conta/cadastro');
        $this->load->view('templates/barra_ferramentas',$ferramentas);
        ?>
        <div class="panel">
            
        </div>
    </div>
</div>

