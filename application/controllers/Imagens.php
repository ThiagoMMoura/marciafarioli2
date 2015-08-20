<?php
class Imagens extends CI_Controller {
	public function thumbs($imagem, $largura, $altura) {
		$config['image_library'] = 'gd';
		$config['source_image'] = str_replace("-", "/", $imagem);
		$config['maintain_ratio'] = true;
		$config['dynamic_output'] = true;
		$config['width'] = $largura;
		$config['quality'] = "100%";
		$config['height'] = $altura;
		
		$this->load->library('image_lib', $config);
		
		if ( ! $this->image_lib->resize())
		{
			echo $this->image_lib->display_errors();
		}
		
		$this->image_lib->clear();
	}
}