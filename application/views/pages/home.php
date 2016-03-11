<?php
$this->load->view('templates/nav_header', $page);
$this->load->helper('directory');
$this->load->view('templates/alertas');
?>
<div class="row">
    <div class="small-12 small-centered columns">
        <? if (array_search('admin-pagina-home-carrosel-editar', $urls_restritas)===FALSE) {
            echo '<small>' . anchor('admin/editar/carrosel', 'Editar') . '</small>';
        } ?>
        <div class="carrosel">
            <?
            $pasta = './images/site/pagina/home/carrosel/';
            $map = directory_map($pasta, 1);
            foreach ($map as $img) {
                ?>
                <div><?= img($pasta . $img); ?></div>
            <? } ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="small-12 large-10 columns">
        <? $this->load->view('templates/news'); ?>
    </div>
</div>
<?php $this->load->view('templates/footer'); ?>