<div class="row">
  <div class="small-12 columns">
  <?php 
	if(isset($error)){
		echo alert_div($error,'alert');
    }
	if(isset($warning)){
		echo alert_div($warning,'warning');
	}
	if(isset($success)){
		echo alert_div($success,'success');
	}
	if(isset($info)){
		echo alert_div($info,'info');
	}
	if(isset($mensagem)){
		echo alert_div($mensagem,'secondary');
	}
	?>
  </div>
</div>