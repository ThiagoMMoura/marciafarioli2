<?php $this->load->view('templates/nav_header', $page); ?>
<div class="row">
    <div class="small-12 small-centered columns">
        <div class="slick-principal">
            <div class="caixa_corte"><img src="<?php echo SITEURL.'/'.IMAGES_PATH ?>/site/construindo marcia farioli0041.jpg" /></div>
            <div class="caixa_corte"><img src="<?php echo SITEURL.'/'.IMAGES_PATH ?>/site/construindo marcia farioli0042.jpg" /></div>
            <div class="caixa_corte"><img src="<?php echo SITEURL.'/'.IMAGES_PATH ?>/site/construindo marcia farioli0043.jpg" /></div>
        </div>
    </div>
</div>
<div class="row">
  <div class="small-12 large-10 columns">
    <?php $this->load->view('templates/news'); ?>
  </div>
</div>
<?php $this->load->view('templates/footer'); ?>