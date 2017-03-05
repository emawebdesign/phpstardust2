$(document).ready(function() {
		
	$('.summernote').summernote({
		height: 300
	});
	
	$('#tags').tagsinput({
	  tagClass: 'label label-success',
	  cancelConfirmKeysOnEmpty: false
	});

});

function deleteImage(url, confirmMessage) {
	
	var checkConfirm = confirm(confirmMessage);
	
	if (checkConfirm) {

		$('#images').html('');
		$('.alert-warning').removeClass('hidden');	
		
		$.getJSON(url, function( json ) {
			
			if (json.response=="ok") {
				$('#images').html('');
				$('.alert-warning').addClass('hidden');	
			}
		  
		});
	
	}
	
}