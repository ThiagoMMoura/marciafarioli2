// JavaScript Document
$(document).ajaxComplete(function() {
  if($( "img[id~='imgcrop']" ).has('src')){
	jQuery(function($) {
	  $('#imgcrop').Jcrop({
		  bgColor:     'black',
		  bgOpacity:   .4,
		  aspectRatio: 10 / 4,
		  maxSize: [1000,400],
		  setSelect: [0,0,0,1000]
	  });
	});
	$('#btnsalvar').show();
  }else{
	  $('#btnsalvar').hide();
  }
});
jQuery(document).ready(function() { 
$('#btnsalvar').hide();
var options = { 
        target:        '#imgupload'   // target element(s) to be updated with server response 
        // beforeSubmit:  showRequest,  pre-submit callback 
        /*success: function showResponse(data){ 
			  var result = JSON.parse( data );                             	                        
			  $('#imgupload').html(result.date);
		  }   post-submit callback*/
		}; 
		// other available options: 
        //url:       url         // override for form's 'action' attribute 
        //type:      type        // 'get' or 'post', override for form's 'method' attribute 
        //dataType:  null        // 'xml', 'script', or 'json' (expected server response type) 
        //clearForm: true        // clear all form fields after successful submit 
        //resetForm: true        // reset the form after successful submit 
jQuery('#uploadform').ajaxForm(options);

});