<?php
$this->load->view('templates/nav_header', $page);
$this->load->helper('directory');
$this->load->view('templates/alertas');
?>
<div class="row">
    <div class="small-12 small-centered columns">
        <?php if (array_search('admin-pagina-home-carrosel-editar', $urls_restritas)===FALSE) {
            echo '<small>' . anchor('admin/pagina/home/carrosel', 'Editar') . '</small>';
        } ?>
        <div class="carrosel">
            <?php
            $pasta = './images/site/pagina/home/carrosel/';
            $map = directory_map($pasta, 1);
            if(!empty($map)){
                foreach ($map as $img) {
                    ?>
                    <div><?= img($pasta . $img); ?></div>
                <?php } 
            }?>
        </div>
    </div>
</div>
<div class="row">
    <div class="small-12 large-10 columns">
        <?php $this->load->view('templates/news'); ?>
    </div>
</div>
<?php $this->load->view('templates/footer'); ?>