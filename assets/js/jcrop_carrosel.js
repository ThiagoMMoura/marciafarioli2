// JavaScript Document
$(document).ajaxComplete(function() {
  if($.contains(document.getElementById('imgupload'),document.getElementById('imgcrop'))){
	jQuery(function($) {
	  $('#imgcrop').Jcrop({
		  onChange: getCoordenadas,
		  onSelect: getCoordenadas,
		  bgColor:     'black',
		  bgOpacity:   .4,
		  aspectRatio: 10 / 4,
		  maxSize: [1000,400],
		  setSelect: [0,0,0,1000]
	  });
	});
	$('#btnsalvar').show();
	$('#btncancelar').show();
	$('#url').val($('#imgcrop').attr('src'));
  }else{
	  $('#btnsalvar').hide();
  }
});
function getCoordenadas(c){
	$('#x').val(c.x);
	$('#y').val(c.y);
	$('#x2').val(c.x2);
	$('#y2').val(c.y2);
	$('#w').val(c.w);
	$('#h').val(c.h);
	$('#real-w').val($('.jcrop-holder').css('width'));
	$('#real-h').val($('.jcrop-holder').css('height'));
}
jQuery(document).ready(function() { 
	$('#btnsalvar').hide();
	$('#btncancelar').hide();
	$('#btnenviar').hide();
	var options = { 
        target:        '#imgupload'   // target element(s) to be updated with server response 
        // beforeSubmit:  showRequest,  pre-submit callback 
        /*success: function showResponse(data){ 
			  var result = JSON.parse( data );                             	                        
			  $('#imgupload').html(result.date);
		  }   post-submit callback*/
		// other available options: 
        //url:       url         // override for form's 'action' attribute 
        //type:      type        // 'get' or 'post', override for form's 'method' attribute 
        //dataType:  null        // 'xml', 'script', or 'json' (expected server response type) 
        //clearForm: true        // clear all form fields after successful submit 
        //resetForm: true        // reset the form after successful submit 
	}; 
	jQuery('#userfile').change(function(){
		jQuery('#uploadform').ajaxSubmit(options);
		return false;
	});

});