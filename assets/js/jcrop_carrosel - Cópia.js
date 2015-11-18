// JavaScript Document
$(document).ajaxComplete(function() {
  if($.contains(document.getElementById('imgupload'),document.getElementById('imgcrop'))){
	$('#btnsalvar').show();
	$('#btncancelar').show();
	$('#url').val($('#imgcrop').attr('src'));
  }else{
	  $('#btnsalvar').hide();
  }
});
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