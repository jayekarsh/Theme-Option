// JavaScript Document

$(document).ready(function(){
		
	$( ".wpsm_tabs" ).tabs();
	
	/************** uploader ***********************/
	 var image_custom_uploader;
	 var upload_button_id;
	 
	 $('.wpsm_image_upload').click(function(e) {
	 e.preventDefault();
	 upload_button_id=$(this).attr('id');
	 
	 //If the uploader object has already been created, reopen the dialog
	 if (image_custom_uploader) {
	 image_custom_uploader.open();
	 return;
	 }
	
	 //Extend the wp.media object
	 image_custom_uploader = wp.media.frames.file_frame = wp.media({
	 title: 'Choose Image',
	 button: {
	 text: 'Choose Image'
	 },
	 multiple: false
	 });
	
	 //When a file is selected, grab the URL and set it as the text field's value
	 image_custom_uploader.on('select', function() {
	 attachment = image_custom_uploader.state().get('selection').first().toJSON();
	 var url = '';
	 url = attachment['url'];
	 
	 //upload button id and prepend wpsm_ is the image value field class
	 var upload_value_class = 'wpsm_'+ upload_button_id;
	 
	 $('.'+upload_value_class).val(url);
	 });
	
	 //Open the uploader dialog
	 image_custom_uploader.open();
	 });
	 /************** uploader ***********************/

});




/*
* Function to show messages
*/
function show_message(msg, type)
{
	var msg_class = 'isa_error';
		
	switch(type)
	{
		case 'success':
			msg_class = 'isa_success';
		break;
		case 'error':
			msg_class = 'isa_error';
		break;			
		case 'info':
			msg_class = 'isa_info';
		break;				
		case 'warning':
			msg_class = 'isa_warning';
		break;
	}
	
	$("#wpsm_notifications").html('<div class="'+msg_class+'">'+ msg +'</div>');
	$(window).scrollTop($("#notify_scroll").offset().top);
}



/*
* Function to validate date Y-m-d
*/
function validateDate(date) { 
    var re = '/^([0-9]{4})\-([0-9]{2})\-([0-9]{2})$/';
    return re.test(date);
} 


/*
* Function to validate email
*/
function validateEmail(email) { 
    var re = '/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';
    return re.test(email);
} 

/*
* Function to validate integer number
*/
function isInteger(value) {
 
 	var regex = new RegExp(/^\+?[0-9(),.-]+$/);
    if(value.match(regex)) {return true;}
    return false;
 
}

/*
* Function to validate integer range
*/
function integerInRange(value, min, max) {
  if (isInteger(value)) {
    if (parseInt(value, 10) >= min && parseInt(value, 10 <= max)) {
      return true; 
    } else {
      return false; //not in range
    }
  } else {
    return false; //not an integer
  }
}
