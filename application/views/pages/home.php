<?php 
$this->load->view('templates/nav_header', $page);
$this->load->helper('directory');
?>
<div class="row">
    <div class="small-12 small-centered columns">
    	<?php if(isset($perm)&&$perm->editarhome) echo '<small>'.anchor('admin/editar/carrosel','Editar').'</small>';?>
        <div class="carrosel">
        	<?php
            $pasta = './images/site/carrosel/';
			$map = directory_map($pasta,1);
			foreach($map as $img){ ?>
				<div><?php echo img($pasta.$img); ?></div>
			<?php } ?>
        </div>
    </div>
</div>
<div class="row">
  <div class="small-12 large-10 columns">
    <?php $this->load->view('templates/news'); ?>
  </div>
</div>
<?php $this->load->view('templates/footer'); ?>