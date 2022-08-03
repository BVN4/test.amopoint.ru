const $form = $('.form');
const $file = $('#file');
const $separator = $('#separator');

const $upload = $('.upload');

const $result = $('.result');

$form.on('submit', function(e){
	e.preventDefault();

	$upload.attr('status', 'load');

	let formData = new FormData();
	formData.append('file', $file[0].files[0]);
	formData.append('separator', $separator.val());

	$.ajax({
		type: 'POST',
		url: '/uploadFile.php',
		cache: false,
		contentType: false,
		processData: false,
		data: formData,
		dataType : 'json',
		success: function(msg){
			if(!msg.result) this.error();
			$result.html(msg.result);
			$upload.attr('status', 'success');
		},
		error: function(){
			$upload.attr('status', 'error');
		}
	});

});