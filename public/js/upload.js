$(document).ready(function(){
	var dropZone = $('#upload-container');

	$('#file-input').focus(function() {
		$('label').addClass('focus');
	})
	.focusout(function() {
		$('label').removeClass('focus');
	});


	dropZone.on('drag dragstart dragend dragover dragenter dragleave drop', function(){
		return false;
	});

	dropZone.on('dragover dragenter', function() {
		dropZone.addClass('dragover');
	});

	dropZone.on('dragleave', function(e) {
		let dx = e.pageX - dropZone.offset().left;
		let dy = e.pageY - dropZone.offset().top;
		if ((dx < 0) || (dx > dropZone.width()) || (dy < 0) || (dy > dropZone.height())) {
			dropZone.removeClass('dragover');
		}
	});

	dropZone.on('drop', function(e) {
		dropZone.removeClass('dragover');
		let files = e.originalEvent.dataTransfer.files;
		sendFiles(files);
	});

	$('#userfile').change(function() {
		let files = this.files;
		sendFiles(files);
	});

	function sendFiles(files) {
		console.log('ngvbncvbngcnfcfh');
		let maxFileSize = 1000000;
		$(files).each(function(index, file) {
			if ((file.size <= maxFileSize) && ((file.type == 'image/png') || (file.type == 'image/jpeg'))) {
				$('#upload-container').append('<p id = "success-text"></p>');
				$('#success-text').text("You added: "+file.name);
			}else{
				files[index] = [];
				if(file.size > maxFileSize){
					$('#modal-size').css('display', 'flex');
				}
				if(file.type != 'image/png' && file.type != 'image/jpeg')	{
					$('#modal-type').css('display', 'flex');
				}
			}	
		});
	}
})