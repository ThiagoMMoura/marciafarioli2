    <?php
	$script_list = array(
			'padrao'=>array(
					JQUERY_JS_FILE_LOCAL,
					RESPONSIVE_FW_JS_FILE_LOCAL,
					array('codigo'=>'$(document).foundation();')
					),
			'home'=>array(
					JQUERY_JS_FILE_LOCAL,
					RESPONSIVE_FW_JS_FILE_LOCAL,
					array('codigo'=>'$(document).foundation();'),
					SLICK_JS_FILE_LOCAL,
					SLICK_INI_JS_FILE_LOCAL
					),
			'editar/carrosel'=>array(
					JQUERY_JS_FILE_LOCAL,
					RESPONSIVE_FW_JS_FILE_LOCAL,
					array('codigo'=>'$(document).foundation();'),
					'assets/plugin/jcrop/js/jquery.Jcrop.min.js'
					)
			);
	$script_list_name = isset($script_list[$page])?$page:'padrao';
	foreach($script_list[$script_list_name] as $key => $script_item){
		echo script_tag($script_item);
	}
	?>
</body>
</html>
