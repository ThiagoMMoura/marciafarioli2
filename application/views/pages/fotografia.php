<?php $this->load->view('templates/nav_header', $page); ?>
<div class="row">
	<div class="text-center">
    	<h1>Página de Fotografia</h1>
		<p>Em construção</p>
    </div>
</div>
<div class="row">
	<div class="small-12">
    	<?php
		$this->load->model('portfolio_post_model');
		$albuns = $this->portfolio_post_model->albuns();
		foreach($albuns as $album => $value){
			
		}
		?>
    </div>
</div>