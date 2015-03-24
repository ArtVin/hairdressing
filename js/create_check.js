$(document).ready(function() {
$('#submit').click(function(eventObject) {
	var error = 0;
	$(':text').each(function() {
		if($(this).val() == "") error++;
	});
	if($('textarea').val() == "") error++;
	if (error > 0) {
		eventObject.preventDefault();
		$('#hint').css('color', 'red');
	}
});
});

